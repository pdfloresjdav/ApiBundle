# DoYouBuzz API connection bundle

To do some custom needs , do not forget to fork and to rtfm [Documentation](http://doc.doyoubuzz.com).

## Requirements

You must :

* have a symfony2 projet : >= v2.1
* have a DoYouBuzz API Key and API Secret
* have a local webserver with cURL installed
* know if you have a Partner or Application access

# Installation

##With composer

[dyb/api-dundle](https://packagist.org/packages/dyb/api-bundle)

"require": {
        "dyb/api-bundle": "dev-master"
    },

#Configuration


Register Bundle :

Add this line to your AppKernel.php :

    new Dyb\ApiBundle\DybApiBundle(),

Declare the route in your routing.yml :

    dyb_showcase:
        resource: "@DybApiBundle/Controller/Showcase/"
        type:     annotation
        prefix:   /dyb/showcase/

Add the line below to your config. For example in your app/config/config.yml :

    dyb_api:
        showcase:
            key:       xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
            secret:    xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

#Features

##Showcase :

###Get the list of your users, paginated :

    [
        {"username":"john@doe.me","email":"john@doe.me","firstname":"john","lastname":"doe","id":311243},
        {"username":"jane@doe.me","email":"jane@doe.me","firstname":"jane","lastname":"doe","id":311245}
    ]

**Go to this url : /dyb/showcase/list**

###Get a choice list of your users

    {
        "1":"John Doe",
        "2":"Jane Doe"
    }


**Go to this url : /dyb/showcase/choice**
