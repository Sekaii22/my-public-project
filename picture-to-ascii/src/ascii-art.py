import cv2
import numpy as np
import math
from PIL import Image
import sys
import getopt

def printHelp():
    print("flags: -h/--help, -e/--edge, -w/--width, -f/--file \n \
          -h/--help: Prints help \n \
          -e/--edge: Generate ASCII art with more defined edges \n \
          -w/--width: (argument required: int=200) Set the generated ASCII art width \n \
          -f/--file: (argument required: string) Set file path to image\
          ")

def image2AsciiString(image: Image, new_width: int, ASCII_chars: list, min_thres: int=30) -> str:
    width, height = image.size
    ratio = height/width
    new_height = new_width * ratio * 0.5        # 0.5 is to account for the height of a typical character which is always longer than the width

    # ASCII_chars given should have ascii char stored from lightest to darkest,
    groups = 254 / (len(ASCII_chars) - 1)

    ## resize image and convert to grayscale
    im = image.resize((new_width, int(new_height)))
    im = im.convert("L")

    ## flatten and stretch pixel value to the full range of 0-255, any pixel val < min_thres is set to 0
    flatten_pixels = list(im.getdata())
    norm_val = 255.0 / np.asarray(flatten_pixels).max()

    flatten_pixels = [math.floor(p * norm_val) for p in flatten_pixels]
    if min_thres > 0:
        flatten_pixels = [p if p > min_thres else 0 for p in flatten_pixels]

    ## converting flattened pixels to a string of ascii characters
    new_pixels = [ASCII_chars[int(p // groups)] for p in flatten_pixels]
    new_pixels = ''.join(new_pixels)
    return new_pixels

if __name__ == "__main__":
    try:
        cl_args_list = sys.argv[1:]
        options = "hew:f:"
        long_options = ["help", "edge", "width=", "file="]

        # pic to ascii variables
        new_width = 200
        image_path = None
        strong_edge = False

        arguments, _ = getopt.getopt(cl_args_list, options, long_options)
        for flag, value in arguments:
            if flag in ("-h", "--help"):
                printHelp()
            elif flag in ("-e", "--edge"):
                strong_edge = True
            elif flag in ("-w", "--width"):
                new_width = int(value)
            elif flag in ("-f", "--file"):
                image_path = value

        if not isinstance(new_width, int):
            raise Exception("width value provided is not a valid integar number")

        if image_path != None:
            with Image.open(image_path) as og_im:
                # non-edges ---------------------------------------------------------------------------------------
                chars = list("$BW#oQpwr?~>\"`. ")
                chars.reverse()

                # image to ascii string
                new_pixels = image2AsciiString(og_im, new_width, chars)
                new_pixels_count = len(new_pixels)

                ## arrange the string of characters to form the ascii art
                ASCII_im = []
                for row in range(new_pixels_count // new_width):
                    start = row * new_width
                    end = (row * new_width) + new_width
                    ASCII_im.append(new_pixels[start:end])

                ASCII_im = "\n".join(ASCII_im)

                # exit early if strong-edge flag is not used
                if strong_edge == False:
                    print(ASCII_im)
                    with open("ascii_image.txt", "w+") as f:
                        f.write(ASCII_im)
                    sys.exit(0)

                # strong edges ---------------------------------------------------------------------------------------
                x_chars = list("@|1[]/\\ ")
                y_chars = list("@=~_ ")
                x_chars.reverse()
                y_chars.reverse()

                ## PIL image to cv2 image using og image
                numpy_image = np.array(og_im)
                opencv_image=cv2.cvtColor(numpy_image, cv2.COLOR_RGB2BGR)
                opencv_image=cv2.cvtColor(opencv_image, cv2.COLOR_BGR2GRAY)

                ## median filter
                blurred = cv2.medianBlur(opencv_image, 5)

                ## vertical and horizontal sobel edge detection filter
                grad_x = cv2.Sobel(blurred, cv2.CV_8U, dx=1, dy=0, ksize=3)
                grad_y = cv2.Sobel(blurred, cv2.CV_8U, dx=0, dy=1, ksize=3)
                grad_x = abs(grad_x)
                grad_y = abs(grad_y)

                ## thresholding, pixel value is now 0 and 255 only
                _, thresh_x = cv2.threshold(grad_x, 70, 255, cv2.THRESH_BINARY)
                _, thresh_y = cv2.threshold(grad_y, 70, 255, cv2.THRESH_BINARY)

                ## cv2 image back to PIL image
                thresh_x = cv2.cvtColor(thresh_x, cv2.COLOR_BGR2RGB)
                thresh_y = cv2.cvtColor(thresh_y, cv2.COLOR_BGR2RGB)
                thresh_x = Image.fromarray(thresh_x)
                thresh_y = Image.fromarray(thresh_y)

                # image to ascii string
                new_x_pixels = image2AsciiString(thresh_x, new_width, x_chars, min_thres=0)
                new_y_pixels = image2AsciiString(thresh_y, new_width, y_chars, min_thres=0)

                ## (optional) arrange the string of characters to form the ascii art of x and y edges
                '''
                ASCII_x_im = []
                ASCII_y_im = []

                for row in range(new_pixels_count // new_width):
                    start = row * new_width
                    end = (row * new_width) + new_width
                    ASCII_x_im.append(new_x_pixels[start:end])
                ASCII_x_im = "\n".join(ASCII_x_im)
    
                for row in range(new_pixels_count // new_width):
                    start = row * new_width
                    end = (row * new_width) + new_width
                    ASCII_y_im.append(new_y_pixels[start:end])
                ASCII_y_im = "\n".join(ASCII_y_im)
                '''

                # combine edges and non-edges ascii art ---------------------------------------------------------------------------------------
                xy_pixels = []
                
                for i in range(len(new_pixels)):
                    if new_x_pixels[i] == " " and new_y_pixels[i] == " ":
                        xy_pixels.append(new_pixels[i])
                    elif new_x_pixels[i] == " ":
                        xy_pixels.append(new_y_pixels[i])
                    elif new_y_pixels[i] == " ":
                        xy_pixels.append(new_x_pixels[i])
                    else:
                        xy_pixels.append("@")

                xy_pixels = ''.join(xy_pixels)

                ASCII_xy_im = []
                for row in range(new_pixels_count // new_width):
                    start = row * new_width
                    end = (row * new_width) + new_width
                    ASCII_xy_im.append(xy_pixels[start:end])

                ASCII_xy_im = "\n".join(ASCII_xy_im)
                print(ASCII_xy_im)
                
                with open("ascii_image.txt", "w+") as f:
                    f.write(ASCII_xy_im)
                # (optional) write non-edge and edges to separate files
                '''
                with open("ascii_non_edge.txt", "w+") as f:
                    f.write(ASCII_im)
                with open("ascii_x_edge.txt", "w+") as f:
                    f.write(ASCII_x_im)
                with open("ascii_y_edge.txt", "w+") as f:
                    f.write(ASCII_y_im)
                ''' 

    except Exception as error:
        print("Error occured:" ,error)