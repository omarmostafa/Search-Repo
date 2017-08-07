# Features

  - Consume API and retrieve hotels
  - use search techniques to filter items using name , city , price and date range
  - allow sorting by name and price using merge sort

# Frmework
 - Lumen Framework

### Installation

Require PHP 7.1 to run

Install Composer

Install the dependencies and devDependencies and start the server.

```sh
$ cd /path/to/folder
$ composer install
```

### Run Project

```sh
$ php -S localhost:8000 -t public
```


### Run Unit Testing

```sh
$ ./vendor/bin/phpunit
```



# Request
    - url : base_url/search
    - Example : {"name": "media","city":"dubai","dates":{"from":"10-10-2020","to":"15-10-2020"},"price":{"from":100,"to":105},"sorted_by":"name","sort":"DESC"}
    - you can remove any of the following if you don't need to filter by any one of its
    - sorted_by must be name or price
    - sort must be ASC or DESC

# Assumptions
 - Default Sorting is by Price and ASC if you don't entered sorting


# Algorithms
 - Merge Sort because of its complexity is O(n * log(n)) but Quick sort is O(n2)




