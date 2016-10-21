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


interface OrderLogServiceIf {
  /**
   * @param \Thrift\Server\Order\OrderLogs $orderLogs
   * @return string
   */
  public function createOrderLog(\Thrift\Server\Order\OrderLogs $orderLogs);
  /**
   * @param string $orderId
   * @param string $userName
   * @param string $category
   * @param string $subCate
   * @param string $startTime
   * @param string $endTime
   * @param int $page
   * @param int $size
   * @return \Thrift\Server\Order\PageOrderLogs
   */
  public function getOrderLogBySearch($orderId, $userName, $category, $subCate, $startTime, $endTime, $page, $size);
}

class OrderLogService implements \Thrift\Server\Order\OrderLogServiceIf {
  protected $input_ = null;
  protected $output_ = null;

  protected $seqid_ = 0;

  public function __construct($input, $output=null) {
    $this->input_ = $input;
    $this->output_ = $output ? $output : $input;
  }

  public function createOrderLog(\Thrift\Server\Order\OrderLogs $orderLogs)
  {
    $this->send_createOrderLog($orderLogs);
    return $this->recv_createOrderLog();
  }

  public function send_createOrderLog(\Thrift\Server\Order\OrderLogs $orderLogs)
  {
    $args = new \Thrift\Server\Order\OrderLogService_createOrderLog_args();
    $args->orderLogs = $orderLogs;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'createOrderLog', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('createOrderLog', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_createOrderLog()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Thrift\Server\Order\OrderLogService_createOrderLog_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \Thrift\Server\Order\OrderLogService_createOrderLog_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    throw new \Exception("createOrderLog failed: unknown result");
  }

  public function getOrderLogBySearch($orderId, $userName, $category, $subCate, $startTime, $endTime, $page, $size)
  {
    $this->send_getOrderLogBySearch($orderId, $userName, $category, $subCate, $startTime, $endTime, $page, $size);
    return $this->recv_getOrderLogBySearch();
  }

  public function send_getOrderLogBySearch($orderId, $userName, $category, $subCate, $startTime, $endTime, $page, $size)
  {
    $args = new \Thrift\Server\Order\OrderLogService_getOrderLogBySearch_args();
    $args->orderId = $orderId;
    $args->userName = $userName;
    $args->category = $category;
    $args->subCate = $subCate;
    $args->startTime = $startTime;
    $args->endTime = $endTime;
    $args->page = $page;
    $args->size = $size;
    $bin_accel = ($this->output_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_write_binary');
    if ($bin_accel)
    {
      thrift_protocol_write_binary($this->output_, 'getOrderLogBySearch', TMessageType::CALL, $args, $this->seqid_, $this->output_->isStrictWrite());
    }
    else
    {
      $this->output_->writeMessageBegin('getOrderLogBySearch', TMessageType::CALL, $this->seqid_);
      $args->write($this->output_);
      $this->output_->writeMessageEnd();
      $this->output_->getTransport()->flush();
    }
  }

  public function recv_getOrderLogBySearch()
  {
    $bin_accel = ($this->input_ instanceof TBinaryProtocolAccelerated) && function_exists('thrift_protocol_read_binary');
    if ($bin_accel) $result = thrift_protocol_read_binary($this->input_, '\Thrift\Server\Order\OrderLogService_getOrderLogBySearch_result', $this->input_->isStrictRead());
    else
    {
      $rseqid = 0;
      $fname = null;
      $mtype = 0;

      $this->input_->readMessageBegin($fname, $mtype, $rseqid);
      if ($mtype == TMessageType::EXCEPTION) {
        $x = new TApplicationException();
        $x->read($this->input_);
        $this->input_->readMessageEnd();
        throw $x;
      }
      $result = new \Thrift\Server\Order\OrderLogService_getOrderLogBySearch_result();
      $result->read($this->input_);
      $this->input_->readMessageEnd();
    }
    if ($result->success !== null) {
      return $result->success;
    }
    throw new \Exception("getOrderLogBySearch failed: unknown result");
  }

}

// HELPER FUNCTIONS AND STRUCTURES

class OrderLogService_createOrderLog_args {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\Order\OrderLogs
   */
  public $orderLogs = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'orderLogs',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\Order\OrderLogs',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['orderLogs'])) {
        $this->orderLogs = $vals['orderLogs'];
      }
    }
  }

  public function getName() {
    return 'OrderLogService_createOrderLog_args';
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
            $this->orderLogs = new \Thrift\Server\Order\OrderLogs();
            $xfer += $this->orderLogs->read($input);
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
    $xfer += $output->writeStructBegin('OrderLogService_createOrderLog_args');
    if ($this->orderLogs !== null) {
      if (!is_object($this->orderLogs)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('orderLogs', TType::STRUCT, 1);
      $xfer += $this->orderLogs->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class OrderLogService_createOrderLog_result {
  static $_TSPEC;

  /**
   * @var string
   */
  public $success = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRING,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
    }
  }

  public function getName() {
    return 'OrderLogService_createOrderLog_result';
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
        case 0:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->success);
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
    $xfer += $output->writeStructBegin('OrderLogService_createOrderLog_result');
    if ($this->success !== null) {
      $xfer += $output->writeFieldBegin('success', TType::STRING, 0);
      $xfer += $output->writeString($this->success);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class OrderLogService_getOrderLogBySearch_args {
  static $_TSPEC;

  /**
   * @var string
   */
  public $orderId = null;
  /**
   * @var string
   */
  public $userName = null;
  /**
   * @var string
   */
  public $category = null;
  /**
   * @var string
   */
  public $subCate = null;
  /**
   * @var string
   */
  public $startTime = null;
  /**
   * @var string
   */
  public $endTime = null;
  /**
   * @var int
   */
  public $page = null;
  /**
   * @var int
   */
  public $size = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        1 => array(
          'var' => 'orderId',
          'type' => TType::STRING,
          ),
        2 => array(
          'var' => 'userName',
          'type' => TType::STRING,
          ),
        3 => array(
          'var' => 'category',
          'type' => TType::STRING,
          ),
        4 => array(
          'var' => 'subCate',
          'type' => TType::STRING,
          ),
        5 => array(
          'var' => 'startTime',
          'type' => TType::STRING,
          ),
        6 => array(
          'var' => 'endTime',
          'type' => TType::STRING,
          ),
        7 => array(
          'var' => 'page',
          'type' => TType::I32,
          ),
        8 => array(
          'var' => 'size',
          'type' => TType::I32,
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['orderId'])) {
        $this->orderId = $vals['orderId'];
      }
      if (isset($vals['userName'])) {
        $this->userName = $vals['userName'];
      }
      if (isset($vals['category'])) {
        $this->category = $vals['category'];
      }
      if (isset($vals['subCate'])) {
        $this->subCate = $vals['subCate'];
      }
      if (isset($vals['startTime'])) {
        $this->startTime = $vals['startTime'];
      }
      if (isset($vals['endTime'])) {
        $this->endTime = $vals['endTime'];
      }
      if (isset($vals['page'])) {
        $this->page = $vals['page'];
      }
      if (isset($vals['size'])) {
        $this->size = $vals['size'];
      }
    }
  }

  public function getName() {
    return 'OrderLogService_getOrderLogBySearch_args';
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
            $xfer += $input->readString($this->userName);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 3:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->category);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 4:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->subCate);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 5:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->startTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 6:
          if ($ftype == TType::STRING) {
            $xfer += $input->readString($this->endTime);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 7:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->page);
          } else {
            $xfer += $input->skip($ftype);
          }
          break;
        case 8:
          if ($ftype == TType::I32) {
            $xfer += $input->readI32($this->size);
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
    $xfer += $output->writeStructBegin('OrderLogService_getOrderLogBySearch_args');
    if ($this->orderId !== null) {
      $xfer += $output->writeFieldBegin('orderId', TType::STRING, 1);
      $xfer += $output->writeString($this->orderId);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->userName !== null) {
      $xfer += $output->writeFieldBegin('userName', TType::STRING, 2);
      $xfer += $output->writeString($this->userName);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->category !== null) {
      $xfer += $output->writeFieldBegin('category', TType::STRING, 3);
      $xfer += $output->writeString($this->category);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->subCate !== null) {
      $xfer += $output->writeFieldBegin('subCate', TType::STRING, 4);
      $xfer += $output->writeString($this->subCate);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->startTime !== null) {
      $xfer += $output->writeFieldBegin('startTime', TType::STRING, 5);
      $xfer += $output->writeString($this->startTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->endTime !== null) {
      $xfer += $output->writeFieldBegin('endTime', TType::STRING, 6);
      $xfer += $output->writeString($this->endTime);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->page !== null) {
      $xfer += $output->writeFieldBegin('page', TType::I32, 7);
      $xfer += $output->writeI32($this->page);
      $xfer += $output->writeFieldEnd();
    }
    if ($this->size !== null) {
      $xfer += $output->writeFieldBegin('size', TType::I32, 8);
      $xfer += $output->writeI32($this->size);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}

class OrderLogService_getOrderLogBySearch_result {
  static $_TSPEC;

  /**
   * @var \Thrift\Server\Order\PageOrderLogs
   */
  public $success = null;

  public function __construct($vals=null) {
    if (!isset(self::$_TSPEC)) {
      self::$_TSPEC = array(
        0 => array(
          'var' => 'success',
          'type' => TType::STRUCT,
          'class' => '\Thrift\Server\Order\PageOrderLogs',
          ),
        );
    }
    if (is_array($vals)) {
      if (isset($vals['success'])) {
        $this->success = $vals['success'];
      }
    }
  }

  public function getName() {
    return 'OrderLogService_getOrderLogBySearch_result';
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
        case 0:
          if ($ftype == TType::STRUCT) {
            $this->success = new \Thrift\Server\Order\PageOrderLogs();
            $xfer += $this->success->read($input);
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
    $xfer += $output->writeStructBegin('OrderLogService_getOrderLogBySearch_result');
    if ($this->success !== null) {
      if (!is_object($this->success)) {
        throw new TProtocolException('Bad type in structure.', TProtocolException::INVALID_DATA);
      }
      $xfer += $output->writeFieldBegin('success', TType::STRUCT, 0);
      $xfer += $this->success->write($output);
      $xfer += $output->writeFieldEnd();
    }
    $xfer += $output->writeFieldStop();
    $xfer += $output->writeStructEnd();
    return $xfer;
  }

}


