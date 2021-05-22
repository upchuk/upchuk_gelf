# GELF integration

Integrates Monolog with Greylog.

## Usage

Install the module and configure the site in `settings.php`:

```
$settings['gelf_config'] = [
  'host' => '1.1.1.1',
  'port' => '2322',
  'source' => 'the site name',
];
```
