#Framework
i used lumen framework

#run project
clone project and run {composer install} command then  {php -S localhost:8000 -t public}

#run unit testing
run {./vendor/bin/phpunit} command


#Request
url : /search
Body : {"name": "media","city":"dubai","dates":{"from":"10-10-2020","to":"15-10-2020"},"price":{"from":100,"to":105},"sorted_by":"name","sort":"DESC"}
you can remove any of the following if you don't need to filter by any one of its

sorted_by must be name or price
sort must be ASC or DESC


#Assumptions
Default Sorting is by Price and ASC if you don't entered sorting


#ِAlgorithms
Merge Sort because of its complexity is O(n * log(n)) but Quick sort is O(n2)




