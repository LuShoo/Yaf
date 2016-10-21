<?php
namespace Thrift\Server\Box;

/**
 * Autogenerated by Thrift Compiler (0.9.2)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


class Equipment {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var string
   */
  public $sncode = null;
  /**
   * @var string
   */
  public $imei = null;
  /**
   * @var string
   */
  public $mac = null;
  /**
   * @var int
   */
  public $batch = null;
  /**
   * @var string
   */
  public $createdAt = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'sncode',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'imei',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'mac',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'batch',
          'type' => TType::I64,
          ),
        6 => array(
          'var' => 'createdAt',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['sncode'])) {
        $this->sncode = $vals['sncode'];
      }
      if (isset($vals['imei'])) {
        $this->imei = $vals['imei'];
      }
      if (isset($vals['mac'])) {
        $this->mac = $vals['mac'];
      }
      if (isset($vals['batch'])) {
        $this->batch = $vals['batch'];
      }
      if (isset($vals['createdAt'])) {
        $this->createdAt = $vals['createdAt'];
      }
    }
  }

  public function getName() {
    return 'Equipment';
  }

  public function read($input)
  {
    $xfer = 0;
    $fname = null;
    $ftype = 0;
    $fid = 0;
    $xfer += $input->readStructBegin($fname);
    while (true)
    {
      $xfer += $input->readFieldBegin($fname, $ftype, $fid);
      if ($ftype == TType::STOP) {
        break;
      }
      switch ($fid)
      {
        case 1:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->id);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->sncode);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->imei);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->mac);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I64) {
            $xfer += $input->readI64($this->batch);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->createdAt);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        default:
          $xfer += $input->skip($ftype);
          break;
      }
      $xfer += $input->readFieldEnd();
    }
    $xfer += $input->readStructEnd();
    return $xfer;
  }

  public function write($output) {
    $xfer = 0;
    $xfer += $output->writeStructBegin('Equipment');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->sncode !== null) {
      $xfer += $output->writeFieldBegin('sncode', TType::STRING, 2);
      $xfer += $output->writeString($this->sncode);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->imei !== null) {
      $xfer += $output->writeFieldBegin('imei', TType::STRING, 3);
      $xfer += $output->writeString($this->imei);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->mac !== null) {
      $xfer += $output->writeFieldBegin('mac', TType::STRING, 4);
      $xfer += $output->writeString($this->mac);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->batch !== null) {
      $xfer += $output->writeFieldBegin('batch', TType::I64, 5);
      $xfer += $output->writeI64($this->batch);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdAt !== null) {
      $xfer += $output->writeFieldBegin('createdAt', TType::STRING, 6);
      $xfer += $output->writeString($this->createdAt);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}