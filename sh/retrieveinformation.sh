!#/bin/bash

#pega o resultado da pesquisa em json
response = $(curl -G --header "Accept: application/json" 'http://api.themoviedb.org/3/search/movie?api_key=4a39f41870b802ea580f47953607b1bc&query='hunger+games'')
response = $(curl -G --header "Accept: application/json" 'http://api.themoviedb.org/3/search/tv?api_key=4a39f41870b802ea580f47953607b1bc&language=en&query='sherlock'')
response = $(curl -G --header "Accept: application/json" 'http://api.themoviedb.org/3/tv/19885?api_key=4a39f41870b802ea580f47953607b1bc')
http://api.themoviedb.org/3/tv/id

$total_results = $(ehco $response | jq .total_results)

if [ $total_results -eq 0]
then
## falhou

elif [ $total_results -eq 1]
then
## resultado certeiro

elif [ $total_results -gt 1]
then
## varios resultados
