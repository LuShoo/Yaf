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


class OrdersAndDetails {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\Order\Orders
   */
  public $orders = null;
  /**
   * @var \Thrift\Server\Order\OrderDetails[]
   */
  public $orderDetails = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'orders',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\Order\Orders',
          ),
        2 => array(
          'var' => 'orderDetails',
          'type' => TType::LST,
          'etype' => TType::STRUCT,
          'elem' => array(
            'type' => TType::STRUCT,
            'class' => '\Thrift\Server\Order\OrderDetails',
            ),
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['orders'])) {
        $this->orders = $vals['orders'];
      }
      if (isset($vals['orderDetails'])) {
        $this->orderDetails = $vals['orderDetails'];
      }
    }
  }

  public function getName() {
    return 'OrdersAndDetails';
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
          if ($ftype == TType::STRUCT) {
            $this->orders = new \Thrift\Server\Order\Orders();
            $xfer += $this->orders->read($input);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 2:
          if ($ftype == TType::LST) {
            $this->orderDetails = array();
            $_size7 = 0;
            $_etype10 = 0;
            $xfer += $input->readListBegin($_etype10, $_size7);
            for ($_i11 = 0; $_i11 < $_size7; ++$_i11)
            {
              $elem12 = null;
              $elem12 = new \Thrift\Server\Order\OrderDetails();
              $xfer += $elem12->read($input);
              $this->orderDetails []= $elem12;
            }
            $xfer += $input->readListEnd();
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
    $xfer += $output->writeStructBegin('OrdersAndDetails');
    if ($this->orders !== null) {
      if (!is_object($this->orders)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('orders', TType::STRUCT, 1);
      $xfer += $this->orders->write($output);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->orderDetails !== null) {
      if (!is_array($this->orderDetails)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('orderDetails', TType::LST, 2);
      {
        $output->writeListBegin(TType::STRUCT, count($this->orderDetails));
        {
          foreach ($this->orderDetails as $iter13)
          {
            $xfer += $iter13->write($output);
          }
        }
        $output->writeListEnd();
      }
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}
