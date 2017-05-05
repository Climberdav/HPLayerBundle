Installation
============
> **IMPORTANT** This Bundle actually in developpment.

> **NOTE:** The bundle is compatible with Symfony `2.8.*` upwards.

1. Download this bundle to your project first. The preferred way to do it is
    to use [Composer](https://getcomposer.org/) package manager:
    
    ``` json
    $ composer require climberdav/hp-layer
    ```
    
    > **NOTE:** If you haven't installed `Composer` yet, check the [installation guide][2].

    > **NOTE:** If you're not using `Composer`, add the `BreadcrumbsBundle` to your autoloader manually.

2. Add this bundle to your application's kernel:
    
    ``` php
    // app/AppKernel.php
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Climberdav\HPLayerBundle\HPLayerBundle(),
            // ...
        );
    }
    ```

3. Configure the bundle in your config:
    
    ``` yaml
    # app/config/config.yml
    hp_layer:
        host: "IP or uri of Hyperlaning Web Service"
        port: "port number (default 80)"
        protocol: "http or https (default http)"
        login: "login of the Hyperlaning Web Service"
        password: "password of the Hyperlaning Web Service"
        root: "root prefix Hyperlaning Web Service (default hpsw)"
    ```
    
    
That's  it for basic configuration. For more options check the [Configuration](#configuration) section.

Usage
=====

In your application controller methods:

``` php
public function yourAction(User $user)
{
    $hpLayer = $this->get("hp_layer");
    // Simple example
    $hpLayer->getVersion();
    
    // change root
    $hpLayer->setRoot("New_Root");
}
```