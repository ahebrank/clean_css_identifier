# Clean CSS Identifier for Expression Engine 2

Take arbitrary text and return a valid CSS identifier.

This is a simple wrapper on the the Drupal function `drupal_clean_css_identifier` from https://api.drupal.org/api/drupal/includes!common.inc/function/drupal_clean_css_identifier/7.x

## Usage:

```
{exp:clean_css_identifer}Some text{/exp:clean_css_identifier}
```

Returns:

```
some-text
```