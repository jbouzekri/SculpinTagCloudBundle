SculpinTagCloudBundle
=====================

This bundle generates a tag cloud in sculpin.

Installation
------------

Using composer, add the dependancy to your composer.json :

``` json
require: {
    "jbouzekri/sculpin-tag-cloud-bundle": "1.*"
}
```

And run the composer update command

Enable the bundle. If you have already have an app/SculpinKernel.php, add this bundle to it otherwise create the file with the following content :

``` php
<?php

class SculpinKernel extends \Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel
{
    protected function getAdditionalSculpinBundles()
    {
        return array(
            'Jb\Bundle\TagCloudBundle\JbTagCloudBundle'
        );
    }
}
```

Then you need to add the tag cloud template and its stylesheets to your project
* Copy the Resources/views/tag_cloud.html file in the _includes folder of your source
* Copy the Resources/public/css/tag_cloud.css file in the css folder of your source (or you can directly add its content in your project stylesheets).

Usage
-----

In a template, you can now call the following twig function :

``` twig
{{ tag_cloud() }}
```

It will generate the html tag cloud.

You can specify a custom template :

``` twig
{{ tag_cloud('my_template.html') }}
```

Configuration
-------------

``` yml
jb_tag_cloud:
    tag_entity: Jb\Bundle\TagCloudBundle\Model\Tag
    tag_cloud_entity: Jb\Bundle\TagCloudBundle\Model\TagCloud
    strategies:
        - jb_sculpin.tag_cloud.strategy.shuffle
        - jb_sculpin.tag_cloud.strategy.percent_size
```

* jb_tag_cloud.tag_entity : the tag entity
* jb_tag_cloud.tag_cloud_entity : the tag cloud entity
* jb_tag_cloud.strategies : A list of services to manipulate the tag cloud. By default, shuffle randomize the order of the tags and percent_size calculate the tag weight based on its number of apparition.

License
-------

[MIT](LICENSE)

This bundle was inspired by the [tag-cloud](https://github.com/lotsofcode/tag-cloud) library from [lotsofcode](https://github.com/lotsofcode)