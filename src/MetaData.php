<?php

namespace Ilias\Opherator;

use Ilias\Opherator\Exceptions\InvalidContentTypeException;

class MetaData
{
  public const CONTENT_JSON = 'json';
  public const CONTENT_XML = 'xml';
  public const CONTENT_HTML = 'html';
  public const CONTENT_TEXT = 'text';
  public const CONTENT_CSV = 'csv';
  public const CONTENT_PDF = 'pdf';
  public const CONTENT_ZIP = 'zip';
  public const CONTENT_IMAGE = 'image';
  public const CONTENT_TYPES = [
    self::CONTENT_JSON => 'Content-Type: application/json; charset=UTF-8',
    self::CONTENT_XML => 'Content-Type: application/xml; charset=UTF-8',
    self::CONTENT_HTML => 'Content-Type: text/html; charset=UTF-8',
    self::CONTENT_TEXT => 'Content-Type: text/plain; charset=UTF-8',
    self::CONTENT_CSV => 'Content-Type: text/csv; charset=UTF-8',
    self::CONTENT_PDF => 'Content-Type: application/pdf',
    self::CONTENT_ZIP => 'Content-Type: application/zip',
    self::CONTENT_IMAGE => 'Content-Type: image/*',
  ];
  private array $contentTypes;

  public function __construct()
  {
    $this->contentTypes = [
      self::CONTENT_JSON => 'Content-Type: application/json; charset=UTF-8',
      self::CONTENT_XML => 'Content-Type: application/xml; charset=UTF-8',
      self::CONTENT_HTML => 'Content-Type: text/html; charset=UTF-8',
      self::CONTENT_TEXT => 'Content-Type: text/plain; charset=UTF-8',
      self::CONTENT_CSV => 'Content-Type: text/csv; charset=UTF-8',
      self::CONTENT_PDF => 'Content-Type: application/pdf',
      self::CONTENT_ZIP => 'Content-Type: application/zip',
      self::CONTENT_IMAGE => 'Content-Type: image/*',
    ];
  }

  public function getContentType(string $contentType = self::CONTENT_JSON)
  {
    $contentType = $this->contentTypes[$contentType] ?? null;
    if (!empty($contentType)) {
      return $contentType;
    }
    throw new InvalidContentTypeException();
  }
}