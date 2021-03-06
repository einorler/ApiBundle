# Variants

Sometimes might be needed an option selection to your documents. Most likely in the e-shops. For that case we created a variant controller helper.
 All you need to do is enable it in configuration with `variants:true`:
 
```yaml
#app/config/config.yml

ongr_api:
    versions:
        v3:
            endpoints:
                product: # This key represents endpoint name which will be used in URL 
                    repository: es.manager.default.product # Required
                    variants: true # Enables variant support, default false. 
```

It will generate new endpoints for your resource:

```

  ongr_api_v3_product_post_wi           POST     ANY      ANY    /api/v3/product                                    
  ongr_api_v3_product_post              POST     ANY      ANY    /api/v3/product/{documentId}                       
  ongr_api_v3_product_post_variant_wi   POST     ANY      ANY    /api/v3/product/{documentId}/_variant              
  ongr_api_v3_product_post_variant      POST     ANY      ANY    /api/v3/product/{documentId}/_variant/{variantId}  
  ongr_api_v3_product_get               GET      ANY      ANY    /api/v3/product/{documentId}                       
  ongr_api_v3_product_get_variant_wi    GET      ANY      ANY    /api/v3/product/{documentId}/_variant              
  ongr_api_v3_product_get_variant       GET      ANY      ANY    /api/v3/product/{documentId}/_variant/{variantId}  
  ongr_api_v3_product_put               PUT      ANY      ANY    /api/v3/product/{documentId}                       
  ongr_api_v3_product_put_variant       PUT      ANY      ANY    /api/v3/product/{documentId}/_variant/{variantId}  
  ongr_api_v3_product_delete            DELETE   ANY      ANY    /api/v3/product/{documentId}                       
  ongr_api_v3_product_delete_variant    DELETE   ANY      ANY    /api/v3/product/{documentId}/_variant/{variantId} 
  

```

> `documentId` is the elasticsearch `_id` of the document.

> `variantId` is the associated array index number of nested variant in the document. 

## Requirements

To make it work you have to create a `Nested` object with the `$variants` name for your document.

e.g.

```php
//AppBundle:Jeans document

/**
 * @ES\Document(type="jeans")
 */
class Jeans
{
    //...

    /**
     * @var Collection
     *
     * @ES\Embedded(class="AppBundle:JeansVariant", multiple=true)
     */
    public $variants;

    public function __construct()
    {
        $this->variants = new Collection();
    }
}

```

> There is important to assign an empty `Collection` in the contruction for your `$variants` variable. 

```php
//AppBundle:JeansVariant nested

/**
 * @ES\Nested
 */
class JeansVariant
{
    /**
     * @var
     *
     * @ES\Property(type="string")
     */
    public $color;
}

```

## How to use

Use it the same way as with the documents. Variant enables a direct access to the specific `variants` field. 
e.g. If you want to add a new color variant to a `Jeans` document with ID 2 sent request:
 
```
 
curl -XPOST http://<your-url>/api/v3/jeans/2/_variant -d '{"color":"black"}'

```

