<?php
namespace Thrift\Server\Charge;

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



class ChargingProductOut {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = -1;
  /**
   * @var int
   */
  public $typeId = -1;
  /**
   * @var string
   */
  public $typeName = "";
  /**
   * @var string
   */
  public $provider = "";
  /**
   * @var string
   */
  public $userProvince = "";
  /**
   * @var string
   */
  public $flow = "";
  /**
   * @var double
   */
  public $price = -1;
  /**
   * @var bool
   */
  public $status = false;
  /**
   * @var string
   */
  public $updated_at = "";
  /**
   * @var string
   */
  public $created_at = "";

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
          'var' => 'typeName',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'provider',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'userProvince',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'flow',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'price',
          'type' => TType::DOUBLE,
          ),
        8 => array(
          'var' => 'status',
          'type' => TType::BOOL,
          ),
        9 => array(
          'var' => 'updated_at',
          'type' => TType::STRING,
          ),
        10 => array(
          'var' => 'created_at',
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
      if (isset($vals['typeName'])) {
        $this->typeName = $vals['typeName'];
      }
      if (isset($vals['provider'])) {
        $this->provider = $vals['provider'];
      }
      if (isset($vals['userProvince'])) {
        $this->userProvince = $vals['userProvince'];
      }
      if (isset($vals['flow'])) {
        $this->flow = $vals['flow'];
      }
      if (isset($vals['price'])) {
        $this->price = $vals['price'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['updated_at'])) {
        $this->updated_at = $vals['updated_at'];
      }
      if (isset($vals['created_at'])) {
        $this->created_at = $vals['created_at'];
      }
    }
  }

  public function getName() {
    return 'ChargingProductOut';
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
            $xfer += $input->readString($this->typeName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->provider);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->userProvince);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->flow);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->price);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::BOOL) {
            $xfer += $input->readBool($this->status);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->updated_at);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 10:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->created_at);
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
    $xfer += $output->writeStructBegin('ChargingProductOut');
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
    if ($this->typeName !== null) {
      $xfer += $output->writeFieldBegin('typeName', TType::STRING, 3);
      $xfer += $output->writeString($this->typeName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->provider !== null) {
      $xfer += $output->writeFieldBegin('provider', TType::STRING, 4);
      $xfer += $output->writeString($this->provider);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->userProvince !== null) {
      $xfer += $output->writeFieldBegin('userProvince', TType::STRING, 5);
      $xfer += $output->writeString($this->userProvince);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->flow !== null) {
      $xfer += $output->writeFieldBegin('flow', TType::STRING, 6);
      $xfer += $output->writeString($this->flow);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->price !== null) {
      $xfer += $output->writeFieldBegin('price', TType::DOUBLE, 7);
      $xfer += $output->writeDouble($this->price);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::BOOL, 8);
      $xfer += $output->writeBool($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->updated_at !== null) {
      $xfer += $output->writeFieldBegin('updated_at', TType::STRING, 9);
      $xfer += $output->writeString($this->updated_at);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->created_at !== null) {
      $xfer += $output->writeFieldBegin('created_at', TType::STRING, 10);
      $xfer += $output->writeString($this->created_at);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}