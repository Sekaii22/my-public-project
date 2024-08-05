import requests
import bs4
import math
import re
import matplotlib.pyplot as plt
import matplotlib.font_manager as fm
from io import BytesIO
from PIL import Image
from datetime import datetime
from multiprocessing import Pool

class SteamApp:
    ''' Each steam game can be represented as a SteamApp object.'''
    def __init__(self, title, steam_url, image_url, final_price, original_price, discount_pct, review):
        self.title = title
        self.steam_url = steam_url
        self.image_url = image_url
        self.original_price = original_price
        self.final_price = final_price
        self.discount_pct = discount_pct
        self.review = review

    def __str__(self):
        # create strikethrough text for original price if there is a discount
        strikethrough_original_price = '' if self.original_price == None \
                                        else '\u0336' + self.get_strikethrough_original_price() + ' '
        final_price = '-' if self.final_price == None else self.final_price
        discount = '-' if self.discount_pct == None else self.discount_pct
        review = '-' if self.review == None else self.review

        return f"Title: {self.title} \n \
        Steam page: {self.steam_url} \n \
        Cover: {self.image_url} \n \
        Price: {strikethrough_original_price}{final_price}\n \
        Discount: {discount}\n \
        Review: {review}"
    
    def get_strikethrough_original_price(self):
        '''Gets the strikethrough text for the original price of game. Returns empty string if there is no original price.'''
        return '' if self.original_price == None else '\u0336'.join(self.original_price)


def get_content(url: str, top_num: int) -> list:
    ''' Get content from Steam. Pass in a steam search page url and the top_num of game entries to return. Returns a list of SteamApp objects.'''
    app_list = []
    html = requests.get(url).text
    soup = bs4.BeautifulSoup(html, 'html.parser')

    # bs4 select method returns a list of tags that matches the css selector
    for tag in soup.select('.search_result_row')[:top_num]:
        # get title, steam_url, original_price, final_price, discount_pct, review, and cover image
        title = tag.select('span.title')[0].get_text()                                                          # each bs4 tag object can be further searched using the select method
        steam_url = tag['href']                                                                                 # attributes of tag objects can be accessed like a dictionary
        original_price = None if len(tag.select('.discount_original_price')) == 0 \
                            else tag.select('.discount_original_price')[0].get_text().replace(',', '')          # replace changes 1,400 to 1400
        final_price = None if len(tag.select('.discount_final_price')) == 0 \
                            else tag.select('.discount_final_price')[0].get_text().replace(',', '')             # returns e.g. S$69.90
        discount_pct = None if len(tag.select('.discount_pct')) == 0 \
                            else tag.select('.discount_pct')[0].get_text()                                      # returns e.g. 90%
        image_url = tag.select('img')[0]['src']                                                                 # gets a small capsule image
        image_url = re.sub(r'capsule.*\.jpg', 'header.jpg', image_url)                                          # the header image can be retrieved just by doing this change                   
        review = None
        if len(tag.select('.search_review_summary')) != 0:
            review_text_split = tag.select('.search_review_summary')[0]['data-tooltip-html'].split('<br>')      # returns in this format "Very Positive<br>93% of the 625,337 user reviews for this game are positive."
            review = f'{review_text_split[0]} ({review_text_split[1]})'

        app = SteamApp(title, steam_url, image_url, final_price, original_price, discount_pct, review)
        app_list.append(app)

    return app_list

def print_tab_content(app_list=None, tab_title: str='', write_to_file: bool=False, show_image: bool=False, pool=None):
    ''' Print search result, with the options of writing results to file and/or displaying a summary image of the result.'''
    if app_list == None: return

    concat_str = ''
    concat_str += '\u0332'.join(tab_title) + '\n'       # adds title 

    # append each game details to concat_str
    for item in app_list:
        concat_str += str(item) + '\n'
    print(concat_str)

    # write to file and/or output image
    if write_to_file == True:
        write_file(concat_str, tab_title)
    if show_image == True:
        show_tab_content_images(app_list, tab_title, pool)

def write_file(text, tab_title: str=''):
    ''' Write text to file with the file name in the format of "{tab_title}_{today's date}".txt.'''
    today = datetime.today().strftime('%d-%m-%y')
    with open(f"output/{tab_title}_{today}.txt", "w+", encoding="utf-8") as f:          # encoding="utf-8" required to show the strikethrough text in txt file
        f.write(text)

def show_tab_content_images(app_list=None, tab_title: str='', pool=None):
    ''' Display the image contents of steam app list in a grid'''
    if app_list == None: return

    # configure figure settings               
    fontentry = fm.FontEntry(fname='font/NotoSansSC-Regular.ttf', name='NotoSansSC')    # create new font entry from custom font that supports CJK characters
    fm.fontManager.ttflist.append(fontentry)                                            # insert custom font into matplotlib font lookup list
    ncol = 4
    nrow = math.ceil(len(app_list) / ncol)
    fig_width = 15
    fig_height = nrow * 2
    fig, axs = plt.subplots(nrow, ncol, figsize=(fig_width, fig_height))
    plt.subplots_adjust(left=0.02, right= 0.98, wspace=0.05, hspace=0.25)               # space between subplots
    fig.set_facecolor('#1f1f1f')                                                        # background color
    fig.suptitle(tab_title, fontsize=15, color='#FFFFFF')                               # title
    axs = axs.flatten()                                                                 # flattens 2d numpy array to 1d for easier indexing
    
    # run image requests in parallel using pool
    image_urls = []
    for item in app_list:
        image_urls.append(item.image_url)
    results = pool.map(requests.get, image_urls)                                        # blocks here until all tasks are done
    results = zip(range(len(app_list)), app_list, results)                              

    # show images on subplots
    for i, item, req in results:
        img_file = BytesIO(req.content)
        img = Image.open(img_file)
        axs[i].imshow(img)

        # configure axes settings
        strikethrough_original_price = '' if item.original_price == None \
                                        else item.get_strikethrough_original_price().replace('$', r'\$') + '\u0336' + '  '                  # '$' sign needs to be escaped to show up in plot
        final_price = '-' if item.final_price == None else item.final_price.replace('$', r'\$')
        axs[i].axis('off')
        axs[i].set_title(f'{item.title}\n({strikethrough_original_price}{final_price})',
                          fontdict = {'fontsize': 8, 'color': '#FFFFFF'}, family=['DejaVu Sans', fontentry.name])                           ## family property sets font priority and fallback font should some character be not available,
                                                                                                                                            ## for custom CJK font, need to add fontentry to font lookup list
        if item.discount_pct != None:
            axs[i].text(0.9, 0.9, f'{item.discount_pct}', fontdict={'fontsize': 9, 'color': '#8ADD11'}, horizontalalignment='center', 
                        verticalalignment='top', transform=axs[i].transAxes, backgroundcolor='#4C6B22')                                     ## transform=ax.transAxes indicates that the coordinates are given relative to the axes bounding box, 
                                                                                                                                            ## with (0, 0) being the lower left of the axes and (1, 1) the upper right.
    # remove any empty subplots
    for ax in axs[len(app_list):]:
        ax.remove()