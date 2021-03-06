<?php
namespace Thrift\Server\Order;

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


class Orders {
  static $_TSPEC;

  /**
   * @var int
   */
  public $id = null;
  /**
   * @var string
   */
  public $orderId = null;
  /**
   * @var int
   */
  public $status = null;
  /**
   * @var int
   */
  public $identifyStatus = null;
  /**
   * @var int
   */
  public $orderType = null;
  /**
   * @var double
   */
  public $orderAmount = null;
  /**
   * @var double
   */
  public $settlementAmount = null;
  /**
   * @var double
   */
  public $couponAmount = null;
  /**
   * @var double
   */
  public $payableAmount = null;
  /**
   * @var double
   */
  public $freight = null;
  /**
   * @var string
   */
  public $payType = null;
  /**
   * @var string
   */
  public $receiveName = null;
  /**
   * @var string
   */
  public $receiveAddress = null;
  /**
   * @var string
   */
  public $receiveTel = null;
  /**
   * @var string
   */
  public $idenTel = null;
  /**
   * @var string
   */
  public $idenName = null;
  /**
   * @var string
   */
  public $NRIC = null;
  /**
   * @var string
   */
  public $source = null;
  /**
   * @var string
   */
  public $receiptType = null;
  /**
   * @var string
   */
  public $receiptTitle = null;
  /**
   * @var string
   */
  public $receiptContent = null;
  /**
   * @var string
   */
  public $remarks = null;
  /**
   * @var string
   */
  public $payTime = null;
  /**
   * @var string
   */
  public $createdAt = null;
  /**
   * @var string
   */
  public $updatedAt = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'id',
          'type' => TType::I32,
          ),
        2 => array(
          'var' => 'orderId',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'status',
          'type' => TType::I16,
          ),
        4 => array(
          'var' => 'identifyStatus',
          'type' => TType::I16,
          ),
        5 => array(
          'var' => 'orderType',
          'type' => TType::I16,
          ),
        6 => array(
          'var' => 'orderAmount',
          'type' => TType::DOUBLE,
          ),
        7 => array(
          'var' => 'settlementAmount',
          'type' => TType::DOUBLE,
          ),
        8 => array(
          'var' => 'couponAmount',
          'type' => TType::DOUBLE,
          ),
        9 => array(
          'var' => 'payableAmount',
          'type' => TType::DOUBLE,
          ),
        10 => array(
          'var' => 'freight',
          'type' => TType::DOUBLE,
          ),
        11 => array(
          'var' => 'payType',
          'type' => TType::STRING,
          ),
        12 => array(
          'var' => 'receiveName',
          'type' => TType::STRING,
          ),
        13 => array(
          'var' => 'receiveAddress',
          'type' => TType::STRING,
          ),
        14 => array(
          'var' => 'receiveTel',
          'type' => TType::STRING,
          ),
        15 => array(
          'var' => 'idenTel',
          'type' => TType::STRING,
          ),
        16 => array(
          'var' => 'idenName',
          'type' => TType::STRING,
          ),
        17 => array(
          'var' => 'NRIC',
          'type' => TType::STRING,
          ),
        18 => array(
          'var' => 'source',
          'type' => TType::STRING,
          ),
        19 => array(
          'var' => 'receiptType',
          'type' => TType::STRING,
          ),
        20 => array(
          'var' => 'receiptTitle',
          'type' => TType::STRING,
          ),
        21 => array(
          'var' => 'receiptContent',
          'type' => TType::STRING,
          ),
        22 => array(
          'var' => 'remarks',
          'type' => TType::STRING,
          ),
        23 => array(
          'var' => 'payTime',
          'type' => TType::STRING,
          ),
        24 => array(
          'var' => 'createdAt',
          'type' => TType::STRING,
          ),
        25 => array(
          'var' => 'updatedAt',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['id'])) {
        $this->id = $vals['id'];
      }
      if (isset($vals['orderId'])) {
        $this->orderId = $vals['orderId'];
      }
      if (isset($vals['status'])) {
        $this->status = $vals['status'];
      }
      if (isset($vals['identifyStatus'])) {
        $this->identifyStatus = $vals['identifyStatus'];
      }
      if (isset($vals['orderType'])) {
        $this->orderType = $vals['orderType'];
      }
      if (isset($vals['orderAmount'])) {
        $this->orderAmount = $vals['orderAmount'];
      }
      if (isset($vals['settlementAmount'])) {
        $this->settlementAmount = $vals['settlementAmount'];
      }
      if (isset($vals['couponAmount'])) {
        $this->couponAmount = $vals['couponAmount'];
      }
      if (isset($vals['payableAmount'])) {
        $this->payableAmount = $vals['payableAmount'];
      }
      if (isset($vals['freight'])) {
        $this->freight = $vals['freight'];
      }
      if (isset($vals['payType'])) {
        $this->payType = $vals['payType'];
      }
      if (isset($vals['receiveName'])) {
        $this->receiveName = $vals['receiveName'];
      }
      if (isset($vals['receiveAddress'])) {
        $this->receiveAddress = $vals['receiveAddress'];
      }
      if (isset($vals['receiveTel'])) {
        $this->receiveTel = $vals['receiveTel'];
      }
      if (isset($vals['idenTel'])) {
        $this->idenTel = $vals['idenTel'];
      }
      if (isset($vals['idenName'])) {
        $this->idenName = $vals['idenName'];
      }
      if (isset($vals['NRIC'])) {
        $this->NRIC = $vals['NRIC'];
      }
      if (isset($vals['source'])) {
        $this->source = $vals['source'];
      }
      if (isset($vals['receiptType'])) {
        $this->receiptType = $vals['receiptType'];
      }
      if (isset($vals['receiptTitle'])) {
        $this->receiptTitle = $vals['receiptTitle'];
      }
      if (isset($vals['receiptContent'])) {
        $this->receiptContent = $vals['receiptContent'];
      }
      if (isset($vals['remarks'])) {
        $this->remarks = $vals['remarks'];
      }
      if (isset($vals['payTime'])) {
        $this->payTime = $vals['payTime'];
      }
      if (isset($vals['createdAt'])) {
        $this->createdAt = $vals['createdAt'];
      }
      if (isset($vals['updatedAt'])) {
        $this->updatedAt = $vals['updatedAt'];
      }
    }
  }

  public function getName() {
    return 'Orders';
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
            $xfer += $input->readString($this->orderId);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->status);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->identifyStatus);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::I16) {
            $xfer += $input->readI16($this->orderType);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->orderAmount);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->settlementAmount);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->couponAmount);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 9:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->payableAmount);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 10:
          if ($ftype == TType::DOUBLE) {
            $xfer += $input->readDouble($this->freight);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 11:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->payType);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 12:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->receiveName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 13:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->receiveAddress);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 14:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->receiveTel);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 15:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->idenTel);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 16:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->idenName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 17:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->NRIC);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 18:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->source);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 19:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->receiptType);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 20:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->receiptTitle);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 21:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->receiptContent);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 22:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->remarks);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 23:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->payTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 24:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->createdAt);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 25:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->updatedAt);
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
    $xfer += $output->writeStructBegin('Orders');
    if ($this->id !== null) {
      $xfer += $output->writeFieldBegin('id', TType::I32, 1);
      $xfer += $output->writeI32($this->id);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->orderId !== null) {
      $xfer += $output->writeFieldBegin('orderId', TType::STRING, 2);
      $xfer += $output->writeString($this->orderId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->status !== null) {
      $xfer += $output->writeFieldBegin('status', TType::I16, 3);
      $xfer += $output->writeI16($this->status);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->identifyStatus !== null) {
      $xfer += $output->writeFieldBegin('identifyStatus', TType::I16, 4);
      $xfer += $output->writeI16($this->identifyStatus);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->orderType !== null) {
      $xfer += $output->writeFieldBegin('orderType', TType::I16, 5);
      $xfer += $output->writeI16($this->orderType);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->orderAmount !== null) {
      $xfer += $output->writeFieldBegin('orderAmount', TType::DOUBLE, 6);
      $xfer += $output->writeDouble($this->orderAmount);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->settlementAmount !== null) {
      $xfer += $output->writeFieldBegin('settlementAmount', TType::DOUBLE, 7);
      $xfer += $output->writeDouble($this->settlementAmount);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->couponAmount !== null) {
      $xfer += $output->writeFieldBegin('couponAmount', TType::DOUBLE, 8);
      $xfer += $output->writeDouble($this->couponAmount);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->payableAmount !== null) {
      $xfer += $output->writeFieldBegin('payableAmount', TType::DOUBLE, 9);
      $xfer += $output->writeDouble($this->payableAmount);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->freight !== null) {
      $xfer += $output->writeFieldBegin('freight', TType::DOUBLE, 10);
      $xfer += $output->writeDouble($this->freight);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->payType !== null) {
      $xfer += $output->writeFieldBegin('payType', TType::STRING, 11);
      $xfer += $output->writeString($this->payType);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->receiveName !== null) {
      $xfer += $output->writeFieldBegin('receiveName', TType::STRING, 12);
      $xfer += $output->writeString($this->receiveName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->receiveAddress !== null) {
      $xfer += $output->writeFieldBegin('receiveAddress', TType::STRING, 13);
      $xfer += $output->writeString($this->receiveAddress);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->receiveTel !== null) {
      $xfer += $output->writeFieldBegin('receiveTel', TType::STRING, 14);
      $xfer += $output->writeString($this->receiveTel);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->idenTel !== null) {
      $xfer += $output->writeFieldBegin('idenTel', TType::STRING, 15);
      $xfer += $output->writeString($this->idenTel);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->idenName !== null) {
      $xfer += $output->writeFieldBegin('idenName', TType::STRING, 16);
      $xfer += $output->writeString($this->idenName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->NRIC !== null) {
      $xfer += $output->writeFieldBegin('NRIC', TType::STRING, 17);
      $xfer += $output->writeString($this->NRIC);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->source !== null) {
      $xfer += $output->writeFieldBegin('source', TType::STRING, 18);
      $xfer += $output->writeString($this->source);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->receiptType !== null) {
      $xfer += $output->writeFieldBegin('receiptType', TType::STRING, 19);
      $xfer += $output->writeString($this->receiptType);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->receiptTitle !== null) {
      $xfer += $output->writeFieldBegin('receiptTitle', TType::STRING, 20);
      $xfer += $output->writeString($this->receiptTitle);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->receiptContent !== null) {
      $xfer += $output->writeFieldBegin('receiptContent', TType::STRING, 21);
      $xfer += $output->writeString($this->receiptContent);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->remarks !== null) {
      $xfer += $output->writeFieldBegin('remarks', TType::STRING, 22);
      $xfer += $output->writeString($this->remarks);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->payTime !== null) {
      $xfer += $output->writeFieldBegin('payTime', TType::STRING, 23);
      $xfer += $output->writeString($this->payTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->createdAt !== null) {
      $xfer += $output->writeFieldBegin('createdAt', TType::STRING, 24);
      $xfer += $output->writeString($this->createdAt);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->updatedAt !== null) {
      $xfer += $output->writeFieldBegin('updatedAt', TType::STRING, 25);
      $xfer += $output->writeString($this->updatedAt);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

