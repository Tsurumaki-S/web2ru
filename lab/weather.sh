#!/bin/bash

FILE_1="weather.json"
FILE_2="weather.dat"

curl "http://api.openweathermap.org/data/2.5/forecast?q=Nagoya&appid=fd1f0110c390d7371a134e371b3591fd" \
> ${FILE_1} \
&& \
cat ${FILE_1} | jq '.list[0] | .dt' > ${FILE_2}


