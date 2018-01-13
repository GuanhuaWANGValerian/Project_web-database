
#!usr/bin/env python3
#coding=utf-8
import re
airports = open("regions_cn.csv", "x")
with open("regions.csv", 'r') as file:
	contenu = file.readlines()
	airports.write(contenu[0])
	pattern = re.compile("CN")
	for line in contenu:
		content = line.split(",")
		if pattern.search(content[5]):
			airports.write(line)
airports.close()

