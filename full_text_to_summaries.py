
# coding: utf-8

# In[113]:

from gensim import corpora, models, similarities
from gensim.models import hdpmodel, ldamodel
from itertools import izip
import pickle


# In[114]:

##returns topics from a body of text
def return_topics(filename, num_topics):
    documents = open(filename)

    # remove common words and tokenize
    stoplist = set('for a of the so been its their our all them -- with each without th there however basic but by and to on would an is if us can they are or it have we you any very it first just your do this at from who that had here not was after out not which be were as what in'.split())
    texts = [[word for word in document.lower().split() if word not in stoplist]
             for document in documents]

    # remove words that appear only once
    all_tokens = sum(texts, [])
    tokens_once = set(word for word in set(all_tokens) if all_tokens.count(word) == 1)
    texts = [[word for word in text if word not in tokens_once]
             for text in texts]

    dictionary = corpora.Dictionary(texts)
    corpus = [dictionary.doc2bow(text) for text in texts]
 
    lda = ldamodel.LdaModel(corpus, id2word=dictionary, num_topics=num_topics, iterations=10, passes=15, alpha=.0001)
    corpus_lda = lda[corpus]
    best = lda.show_topics(num_words=7)[0]
    
    result = ''.join([i for i in best if not i.isdigit()])
    #resultF = ''.join(e for e in result if e.isalnum())
    resultF = "".join(c for c in result if c not in ("'","*","+",'!','.',':'))

    return (resultF).split()


# In[114]:




# In[115]:

###GET THE URLS BASED ON the main topics
##Google Search API

#from pygoogle import pygoogle
from google_search import GoogleCustomSearch
import os


# In[116]:

def google_keyword_search(keyword):
    SEARCH_ENGINE_ID = ('016858905314894302733:tgccnmghyju')                        
    API_KEY = ('AIzaSyCdxszOvSKowRZfOxHWBe1ccigjR35t73k ')

    api = GoogleCustomSearch(SEARCH_ENGINE_ID, API_KEY)
    
    links = []
    for result in api.search(keyword):
        links.append((result['link']))
    return links


# In[117]:

import urllib
from bs4 import BeautifulSoup
##take out html


# In[118]:

def strip_html(url):
    html = urllib.urlopen(url).read()
    soup = BeautifulSoup(html)

    # kill all script and style elements
    for script in soup(["script", "style"]):
        script.extract()    # rip it out

    # get text
    text = soup.get_text()

    # break into lines and remove leading and trailing space on each
    lines = (line.strip() for line in text.splitlines())
    # break multi-headlines into a line each
    chunks = (phrase.strip() for line in lines for phrase in line.split("  "))
    # drop blank lines
    text = '\n'.join(chunk for chunk in chunks if chunk)
    
    
    tokenizer = nltk.data.load('tokenizers/punkt/english.pickle')
    '''
    fp = open("test.txt")
    data = fp.read()
    '''
    text = '\n-----\n'.join(tokenizer.tokenize(text.strip()))

    return text


# In[118]:




# In[118]:




# In[118]:


    


# In[129]:

from __future__ import absolute_import
from __future__ import division, print_function, unicode_literals

from sumy.parsers.html import HtmlParser
from sumy.parsers.plaintext import PlaintextParser
from sumy.nlp.tokenizers import Tokenizer
from sumy.summarizers.lsa import LsaSummarizer as Summarizer
from sumy.nlp.stemmers import Stemmer
from sumy.utils import get_stop_words


# In[130]:

##summarizing using sumy
def summarize_url_best(url, sentences):
    LANGUAGE = "English"
    SENTENCES_COUNT = sentences
    parser = HtmlParser.from_url(url, Tokenizer(LANGUAGE))
    # or for plain text files
    # parser = PlaintextParser.from_file("document.txt", Tokenizer(LANGUAGE))
    stemmer = Stemmer(LANGUAGE)

    summarizer = Summarizer(stemmer)
    summarizer.stop_words = get_stop_words(LANGUAGE)

    for sentence in summarizer(parser.document, SENTENCES_COUNT):
        print(sentence)


# In[131]:

import summarize
import nltk


# In[132]:

def summarize_url(url, sentences):
    text = strip_html(url)
    ss = summarize.SimpleSummarizer()
    print ss.summarize(text, sentences)


# In[158]:

def full_function(filename, num_topics=5, num_sentences_for_each_resource=2):
    #### First get the topics from the text file, 5 topics
    doc_topics = return_topics(filename, num_topics)
    print ("The main topics we were able to extract out of this article were")
    print (doc_topics)
    print ('\n')

    #### Next we search google for the first 2 topics
    summary_links = []
    for item in doc_topics[:2]:
        topic = google_keyword_search(item)
        summary_links.append(topic[0])
        summary_links.append(topic[1])##append first and second link from that topic

    ##then we summarize those url items

    print ('Associated resources to your topics and their summaries are listed below\n')
    for link in summary_links:
        print (link)
        summarize_url_best(link, num_sentences_for_each_resource)##2 sentences for each resource
        print ('\n')



# In[158]:




# In[158]:




# In[ ]:



