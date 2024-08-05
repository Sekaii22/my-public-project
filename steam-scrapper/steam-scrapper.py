import sys
import getopt
import time
import matplotlib.pyplot as plt
from multiprocessing import Pool
import helper

def printHelp():
    print(" This program scrapes data off Steam for new releases, top sellers, popular upcoming, and discounted games. \n \
          flags: -h/--help, -w/--write, -i/--image, -t/--top \n \
          -h/--help: Prints help \n \
          -w/--write: Write scrapped data to text in output folder \n \
          -i/--image: Display scrapped content as an image  \n \
          -t/--top: (argument required: int) Set the top number of games for each category to retrieve \n")

if __name__ == "__main__":
    try: 
        cl_args_list = sys.argv[1:]
        options = 'hwit:'
        long_options = ["help", 'write', 'image', 'top=']

        urls = {'new_releases': 'https://store.steampowered.com/search/?sort_by=Released_DESC&category1=998%2C21&supportedlang=english&filter=popularnew&ndl=1',
        'top_sellers': 'https://store.steampowered.com/search/?category1=998%2C21&supportedlang=english&hidef2p=1&filter=globaltopsellers&ndl=1',
        'pop_upcoming': 'https://store.steampowered.com/search/?category1=998%2C21&supportedlang=english&filter=popularcomingsoon&ndl=1',
        'specials': 'https://store.steampowered.com/search/?category1=998%2C21&supportedlang=english&specials=1&ndl=1'}
        top_num = 10
        towrite = False
        toshowimage = False

        arguments, _ =  getopt.getopt(cl_args_list, options, long_options)
        for flag, value in arguments:
            if flag in ['-h', '--help']:
                printHelp()
                sys.exit(0)
            elif flag in ['-w', '--write']:
                towrite = True
            elif flag in ['-i', '--image']:
                toshowimage = True
            elif flag in ['-t', '--top']:
                try:
                    # cap value at 50
                    top_num = min(int(value), 50)
                except:
                    raise Exception('[-t, --top] argument given is not a valid integer number!')

        # get a list of SteamApp object for each category
        with Pool() as pool:
            start_time = time.time()
            ## apply_async returns a AsyncResult object, use get() to return the value from the function after task is complete
            new_releases = pool.apply_async(helper.get_content, args=(urls['new_releases'], top_num))
            top_sellers = pool.apply_async(helper.get_content, args=(urls['top_sellers'], top_num))
            pop_upcoming = pool.apply_async(helper.get_content, args=(urls['pop_upcoming'], top_num))
            specials = pool.apply_async(helper.get_content, args=(urls['specials'], top_num))

            # print the retrieved list, write to file, and show summary image
            helper.print_tab_content(new_releases.get(), 'Popular New Releases', towrite, toshowimage, pool)
            helper.print_tab_content(top_sellers.get(), 'Global Top Sellers', towrite, toshowimage, pool)
            helper.print_tab_content(pop_upcoming.get(), 'Popular Upcoming', towrite, toshowimage, pool)
            helper.print_tab_content(specials.get(), 'Specials', towrite, toshowimage, pool)
            print(f'{time.time() - start_time} seconds')

            # process pool is closed automatically

        if toshowimage == True: 
            plt.show()

    except Exception as error:
        print(error)

    

    
