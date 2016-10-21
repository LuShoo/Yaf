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


class ChargingOrdersLog {
  static $_TSPEC;

  /**
   * @var string
   */
  public $orderId = null;
  /**
   * @var string
   */
  public $uid = null;
  /**
   * @var string
   */
  public $telephone = null;
  /**
   * @var int
   */
  public $pid = null;
  /**
   * @var string
   */
  public $flow = null;
  /**
   * @var string
   */
  public $price = null;
  /**
   * @var string
   */
  public $remark = null;
  /**
   * @var int
   */
  public $status = null;
  /**
   * @var int
   */
  public $isCharge = null;
  /**
   * @var string
   */
  public $partner = null;
  /**
   * @var string
   */
  public $createdAt = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'orderId',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'uid',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'telephone',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'pid',
          'type' => TType::I32,
          ),
        5 => array(
          'var' => 'flow',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'price',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'remark',
          'type' => TType::STRING,
          ),
        8 => array(
          'var' => 'status',
          'type' => TType::I32,
          ),
        9 => array(
          'var' => 'isCharge',
          'type' => TType::I32,
          ),
        10 => array(
          'var' => 'partner',
          'type' => TType::STRING,
          ),
        11 => array(
          'var' => 'createdAt',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['orderId'])) {
        $this->orderId = $vals['orderId'];
      }
      if (isset($vals['uid'])) {
        $this->uid = $vals['uid'];
      }
      if (isset($vals['telephone'])) {
        $this->telephone = $vals['telephone'];
      }
      if (isset($vals['pid'])) {
        $this->pid = $vals['pid'];
      }
      if (isset($vals['flow'])) {
        $this->flow = $vals['flow'];
      }
      if (isset($vals['price'])) {
        $this->price = $vals['price'];
      }
      if (isset($vals['remark'])) {
        $this->remark = $vals['remark'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['isCharge'])) {
        $this->isCharge = $vals['isCharge'];
      }
      if (isset($vals['partner'])) {
        $this->partner = $vals['partner'];
      }
      if (isset($vals['createdAt'])) {
        $this->createdAt = $vals['createdAt'];
      }
    }
  }

  public function getName() {
    return 'ChargingOrdersLog';
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
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->orderId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->uid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->telephone);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->pid);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->flow);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->price);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->remark);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->status);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->isCharge);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 10:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->partner);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 11:
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
    $xfer += $output->writeStructBegin('ChargingOrdersLog');
    if ($this->orderId !== null) {
      $xfer += $output->writeFieldBegin('orderId', TType::STRING, 1);
      $xfer += $output->writeString($this->orderId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->uid !== null) {
      $xfer += $output->writeFieldBegin('uid', TType::STRING, 2);
      $xfer += $output->writeString($this->uid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->telephone !== null) {
      $xfer += $output->writeFieldBegin('telephone', TType::STRING, 3);
      $xfer += $output->writeString($this->telephone);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->pid !== null) {
      $xfer += $output->writeFieldBegin('pid', TType::I32, 4);
      $xfer += $output->writeI32($this->pid);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->flow !== null) {
      $xfer += $output->writeFieldBegin('flow', TType::STRING, 5);
      $xfer += $output->writeString($this->flow);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->price !== null) {
      $xfer += $output->writeFieldBegin('price', TType::STRING, 6);
      $xfer += $output->writeString($this->price);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->remark !== null) {
      $xfer += $output->writeFieldBegin('remark', TType::STRING, 7);
      $xfer += $output->writeString($this->remark);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::I32, 8);
      $xfer += $output->writeI32($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->isCharge !== null) {
      $xfer += $output->writeFieldBegin('isCharge', TType::I32, 9);
      $xfer += $output->writeI32($this->isCharge);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->partner !== null) {
      $xfer += $output->writeFieldBegin('partner', TType::STRING, 10);
      $xfer += $output->writeString($this->partner);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdAt !== null) {
      $xfer += $output->writeFieldBegin('createdAt', TType::STRING, 11);
      $xfer += $output->writeString($this->createdAt);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

