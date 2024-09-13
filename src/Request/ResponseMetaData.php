<?php

namespace Ilias\Opherator\Request;

use Ilias\Opherator\Exceptions\InvalidContentTypeException;

class ResponseMetaData
{
  const CONTENT_TYPE_JSON = 'json';
  const CONTENT_TYPE_XML = 'xml';
  const CONTENT_TYPE_HTML = 'html';
  const CONTENT_TYPE_TEXT = 'text';
  const CONTENT_TYPE_CSV = 'csv';
  const CONTENT_TYPE_PDF = 'pdf';
  const CONTENT_TYPE_ZIP = 'zip';
  const CONTENT_TYPE_IMAGE = 'image';
  private array $contentTypes;

  public function __construct() {
    $this->contentTypes = [
      self::CONTENT_TYPE_JSON => 'Content-Type: application/json; charset=UTF-8',
      self::CONTENT_TYPE_XML => 'Content-Type: application/xml; charset=UTF-8',
      self::CONTENT_TYPE_HTML => 'Content-Type: text/html; charset=UTF-8',
      self::CONTENT_TYPE_TEXT => 'Content-Type: text/plain; charset=UTF-8',
      self::CONTENT_TYPE_CSV => 'Content-Type: text/csv; charset=UTF-8',
      self::CONTENT_TYPE_PDF => 'Content-Type: application/pdf',
      self::CONTENT_TYPE_ZIP => 'Content-Type: application/zip',
      self::CONTENT_TYPE_IMAGE => 'Content-Type: image/*',
    ];
  }

  public function getContentType(string $contentType = self::CONTENT_TYPE_JSON) {
    $contentType = $this->contentTypes[$contentType] ?? null;
    if (!empty($contentType)) {
      return $contentType;
    }
    throw new InvalidContentTypeException();
  }
}