#! /usr/bin/python 

import sys
import pyPdf

def getPDFContent(path):
    content = ""
    num_pages = 21
    p = file(path, "rb")
    pdf = pyPdf.PdfFileReader(p)
    for i in range(0, num_pages):
        content += pdf.getPage(i).extractText() + "\n"
    content = " ".join(content.replace(u"\xa0", " ").strip().split())
    return content



logfile = open("bioterms.txt", "r").readlines()
counterline = list()
counter = 0

for line in logfile:
    for word in line.split():
        counter+=1
        counterline.append(word)
        print word
print counterline

f= open('test.txt','w')
pdfl = getPDFContent("biotextglossary.pdf").encode("ascii", "ignore")
f.write(pdfl)
f.close()

n = 0

searchfile = open("test.txt", "r")
for line in logfile:
    if "counterline[n]" in line: 
        print line
        n+=1
searchfile.close()


