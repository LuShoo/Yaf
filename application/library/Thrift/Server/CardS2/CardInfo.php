<?php
namespace Thrift\Server\CardS2;

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


class CardInfo {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var int
   */
  public $typeId = null;
  /**
   * @var string
   */
  public $iccid = null;
  /**
   * @var string
   */
  public $batch = null;
  /**
   * @var string
   */
  public $telephone = null;
  /**
   * @var string
   */
  public $status = null;
  /**
   * @var string
   */
  public $updatedAt = null;
  /**
   * @var string
   */
  public $createdAt = null;
  /**
   * @var string
   */
  public $opertor = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'typeId',
          'type' => TType::I32,
          ),
        3 => array(
          'var' => 'iccid',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'batch',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'telephone',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'status',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'updatedAt',
          'type' => TType::STRING,
          ),
        8 => array(
          'var' => 'createdAt',
          'type' => TType::STRING,
          ),
        9 => array(
          'var' => 'opertor',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['typeId'])) {
        $this->typeId = $vals['typeId'];
      }
      if (isset($vals['iccid'])) {
        $this->iccid = $vals['iccid'];
      }
      if (isset($vals['batch'])) {
        $this->batch = $vals['batch'];
      }
      if (isset($vals['telephone'])) {
        $this->telephone = $vals['telephone'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['updatedAt'])) {
        $this->updatedAt = $vals['updatedAt'];
      }
      if (isset($vals['createdAt'])) {
        $this->createdAt = $vals['createdAt'];
      }
      if (isset($vals['opertor'])) {
        $this->opertor = $vals['opertor'];
      }
    }
  }

  public function getName() {
    return 'CardInfo';
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
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->typeId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->iccid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->batch);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->telephone);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->status);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->updatedAt);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->createdAt);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->opertor);
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
    $xfer += $output->writeStructBegin('CardInfo');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->typeId !== null) {
      $xfer += $output->writeFieldBegin('typeId', TType::I32, 2);
      $xfer += $output->writeI32($this->typeId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->iccid !== null) {
      $xfer += $output->writeFieldBegin('iccid', TType::STRING, 3);
      $xfer += $output->writeString($this->iccid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->batch !== null) {
      $xfer += $output->writeFieldBegin('batch', TType::STRING, 4);
      $xfer += $output->writeString($this->batch);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->telephone !== null) {
      $xfer += $output->writeFieldBegin('telephone', TType::STRING, 5);
      $xfer += $output->writeString($this->telephone);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::STRING, 6);
      $xfer += $output->writeString($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->updatedAt !== null) {
      $xfer += $output->writeFieldBegin('updatedAt', TType::STRING, 7);
      $xfer += $output->writeString($this->updatedAt);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdAt !== null) {
      $xfer += $output->writeFieldBegin('createdAt', TType::STRING, 8);
      $xfer += $output->writeString($this->createdAt);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->opertor !== null) {
      $xfer += $output->writeFieldBegin('opertor', TType::STRING, 9);
      $xfer += $output->writeString($this->opertor);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

