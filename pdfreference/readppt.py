from pyPdf import PdfFileWriter, PdfFileReader
import sys
import subprocess
import os

names = []
position = []
inputpdf = PdfFileReader(open("bio.pdf", "rb"))

try:
    os.remove('pptresults.txt')
except OSError:
    pass

for i in xrange(inputpdf.numPages):
    output = PdfFileWriter()
    output.addPage(inputpdf.getPage(i))
    with open("%s.pdf" % i, "wb") as outputStream:
        names.append(str(i))
        print str(i)
        output.write(outputStream)

for num in names:
    print num
    cmd = "sudo python pdf2txt.py -o "+num+".txt "+num+".pdf"
    # no block, it start a sub process.
    p = subprocess.Popen(cmd , shell=True, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    # and you can block util the cmd execute finish
    p.wait()
    # or stdout, stderr = p.communicate()

for num in names:
    logfile = open("bioterms.txt", "r").readlines()
    counterline = list()
    counter = 0
    outp = []

    for line in logfile:
        for word in line.split():
            counter+=1
            counterline.append(word)
        # print word
    #print counterline


    logfile2 = open(num+".txt", "r").readlines()
    counterline2 = list()
    counter2 = 0
    counter3 = 0

    for line in logfile2:
        for word in line.split():
            for reference in counterline:
                if reference in word:
                    kushan = int(num) + 1
                    print kushan
                    outp.append((reference+","+str(kushan)))
    os.remove(num+".txt")
    os.remove(num+".pdf")
    with open("pptresults.txt","a") as f:
        for words in outp:
            f.write(words+"\n")