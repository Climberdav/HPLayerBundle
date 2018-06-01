Installation
---
> **NOTE:** The bundle is compatible with Symfony `3.4.* | 4.0` .

####1 - Install the bundle

Add the bundle and dependencies in your `composer.json` :
   ``` json
    $ composer require climberdav/hp-layer
   ```
***Note:*** If you haven't installed `Composer` yet, check the [installation guide](https://getcomposer.org/download/).

Add this bundle to your application's kernel:
   ``` php
    // app/AppKernel.php
    
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Climberdav\HPLayerBundle\ClimberdavHPLayerBundle(),
            // ...
        );
    }
   ```
Register the routes provided by the bundle:
````yaml
# app/config/routing.yml

climberdav_hp_layer:
  doctrine_manager: default
````

####2 - Set up configuration:

if you wish to use defaults translations provided in this bundle, you have to make sure you have translator enabled in your config.
````yaml
# app/config.config.yml

framework:
  translator: ~
````

####3 - Update the database
````bash
$ php bin/console doctrine:schema:update --force
````

***Note:*** Migrations
If you use doctrine migration create an empty migration file `$ php bin/console doctrine:migrations:generate` and add the following line

````php
    public function up(Schema $schema)
    {
        /*...*/
        $this->addSql('CREATE TABLE hyperplanning_server (id INTEGER NOT NULL,
            previous_server_id INTEGER DEFAULT NULL,
            name VARCHAR(255) NOT NULL, host_ip VARCHAR(255) NOT NULL,
            host_port INTEGER NOT NULL, wsdl_root VARCHAR(255) NOT NULL,
            wsdl_login VARCHAR(255) NOT NULL, wsdl_password VARCHAR(255) NOT NULL,
            protocol VARCHAR(255) NOT NULL, first_day_of_server DATETIME NOT NULL,
            disabled BOOLEAN NOT NULL, version VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))'
        );
        $this->addSql('CREATE UNIQUE INDEX UNIQ_server_id ON hyperplanning_server (previous_server_id)');
        /*...*/
    }
    
    public function down(Schema $schema)
    {
        /*...*/
        $this->addSql('DROP TABLE hyperplanning_server');
        /*...*/
    }
````
then do `$ php bin/console doctrine:migration:migrate`

Now, you can use the bundle and manage your scheduling here : **http://{your-app-root}/server-hyperplanning**

####4 - Override the views

If you'd like to alter the navigation bar shown on `http://{your-app-root}/server-hyperplanning/` you'll want to override the navbar template. This can easily be done by using standard overrides in Symfony, as described here.

In your project, you'll want to copy the views in app/Resources/ClimberdavHPLayerBundle/views/. Any changes to the file in this location will take precedence over the bundle's template file.
 
Usage
---

In your application controller methods:

``` php
public function yourAction()
{
    $em = $this->getContainer->get('doctrine')->getManager('default');
    
    // find all available servers (enabled)
    $wsdlServers = $this->->getRepository('ClimberdavHPLayerBundle:Server')
        ->findEnabledServer();
        
     // find server 1
    $wsdlServer = $this->->getRepository('ClimberdavHPLayerBundle:Server')
            ->find(1);
     // connect to ths WebService
     $wsdlClient = $wsdlServer->connect();
    
    // find all student keys
    $students = $wsdlClient->TousLesEtudiants();
    ...
}
```