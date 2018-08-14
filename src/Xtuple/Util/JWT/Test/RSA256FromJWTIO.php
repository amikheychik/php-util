<?php declare(strict_types=1);

namespace Xtuple\Util\JWT\Test;

/**
 * Keeping public and private keys as exploded base64 encoding to avoid confusion
 * and impression of storing actual private key in repository.
 */
final class RSA256FromJWTIO {
  /**
   * @see https://jwt.io - Algorithm RS256 public key
   * @return string
   */
  public function public(): string {
    /** @noinspection SpellCheckingInspection */
    return base64_decode(implode('', [
      'LS0tLS1CRUdJTiBQVUJMSUMgS0VZLS0tLS0KTUlHZk1BMEdDU3FHU0liM0RRRUJBUVVBQTRHTkFEQ',
      '0JpUUtCZ1FEZGxhdFJqUmpvZ28zV29qZ0dIRkhZTHVnZApVV0FZOWlSM2Z5NGFyV05BMUtvUzhrVn',
      'czM2NKaWJYcjhidndVQVVwYXJDd2x2ZGJINmR2RU9mb3UwL2dDRlFzCkhVZlFyU0R2K011U1VNQWU',
      '4anpLRTRxVytqSyt4UVU5YTAzR1VuS0hra2xlK1EwcFgvZzZqWFo3cjEveEFLNUQKbzJrUStYNXhL',
      'OWNpcFJnRUt3SURBUUFCCi0tLS0tRU5EIFBVQkxJQyBLRVktLS0tLQ==',
    ]));
  }

  /**
   * @see https://jwt.io - Algorithm RS256 private key
   * @return string
   */
  public function private(): string {
    /** @noinspection SpellCheckingInspection */
    return base64_decode(implode('', [
      'LS0tLS1CRUdJTiBSU0EgUFJJVkFURSBLRVktLS0tLQpNSUlDV3dJQkFBS0JnUURkbGF0UmpSam9nb',
      'zNXb2pnR0hGSFlMdWdkVVdBWTlpUjNmeTRhcldOQTFLb1M4a1Z3CjMzY0ppYlhyOGJ2d1VBVXBhck',
      'N3bHZkYkg2ZHZFT2ZvdTAvZ0NGUXNIVWZRclNEditNdVNVTUFlOGp6S0U0cVcKK2pLK3hRVTlhMDN',
      'HVW5LSGtrbGUrUTBwWC9nNmpYWjdyMS94QUs1RG8ya1ErWDV4SzljaXBSZ0VLd0lEQVFBQgpBb0dB',
      'RCtvbkF0VnllNGljN1ZSN1Y1MERGOWJPbndSd05YckFSY0RocTlMV05SclJHRWxFU1lZVFE2RWJhd',
      'FhTCjNNQ3lqalgyZU1odS9hRjVZaFhCd2twcHd4ZytFT21YZWgrTXpMN1poMjg0T3VQYmtnbEFhR2',
      'hWOWJiNi81Q3AKdUdiMWVzeVBiWVcrVHkyUEMwR1NaZklYa1hzNzZqWEF1OVRPQnZEMHliYzJZbGt',
      'DUVFEeXdnMlIvN3QzUTJPRQoyK3lvMzgyQ0xKZHJsU0xWUk9XS3diNHRiMlBqaFk0WEF3VjhkMXZ5',
      'MFJlbnhUQitLNU11NTd1VlNUSHRyTUswCkdBdEZyODMzQWtFQTZhdngyME9IbzYxWWVsYS80azVrU',
      'UR0akVmMU4wTGZJK0JjV1p0eHNTM2pETTNpMUhwMEsKU3,U1cnNDUGI4YWNKbzVSTzI2Z0dWcmZBc',
      '0RjSVhLQytiUUpBWloyWElwc2l0THlQcHVpTU92QmJ6UGF2ZDRnWQo2WjhLV3JmWXpKb0kvUTlGdU',
      'JvNnJLd2w0QkZvVG9EN1dJVVMraHBrYWd3V2l6KzZ6TG9YMWRiT1p3SkFDbUg1CmZTU2pBa0xSaTU',
      '0UEtKOFRGVWVPUDE1aDlzUXp5ZEk4ekpVK3VwdkRFS1pzWmMvVWhUL1N5U0RPeFE0Ry81MjMKWTBz',
      'ei9PWnRTV2NvbC9VTWdRSkFMZXN5KytHZHZvSURMZkpYNUdCUXB1RmdGZW5SaVJEYWJ4ckU5TU5VW',
      'jJhUApGYUZwK0R5QWUrYjRuRHd1SmFXMkxVUmJyOEFFWmdhN29RajB1WXhjWXc9PQotLS0tLUVORC',
      'BSU0EgUFJJVkFURSBLRVktLS0tLQ==',
    ]));
  }
}
