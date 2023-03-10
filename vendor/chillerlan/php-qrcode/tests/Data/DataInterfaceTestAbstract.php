<?php
/**
 * Class DataInterfaceTestAbstract
 *
 * @created      24.11.2017
 * @author       Smiley <smiley@chillerlan.net>
 * @copyright    2017 Smiley
 * @license      MIT
 */

namespace chillerlan\QRCodeTest\Data;

use chillerlan\QRCode\Common\{MaskPattern, Version};
use chillerlan\QRCode\QROptions;
use PHPUnit\Framework\TestCase;
use chillerlan\QRCode\Data\{Hanzi, QRCodeDataException, QRData, QRDataModeInterface, QRMatrix};
use ReflectionClass;

use function str_repeat;

/**
 * The data interface test abstract
 */
abstract class DataInterfaceTestAbstract extends TestCase{

	protected ReflectionClass $reflection;
	protected QRData          $QRData;
	protected string          $FQN;
	protected string          $testdata;

	protected function setUp():void{
		$this->QRData     = new QRData(new QROptions);
		$this->reflection = new ReflectionClass($this->QRData);
	}

	/**
	 * Verifies the QRData instance
	 */
	public function testInstance():void{
		$this::assertInstanceOf(QRData::class, $this->QRData);
	}

	/**
	 * Verifies the QRDataModeInterface instance
	 */
	public function testDataModeInstance():void{
		$datamode = new $this->FQN($this->testdata);

		$this::assertInstanceOf(QRDataModeInterface::class, $datamode);
	}

	/**
	 * @see testInitMatrix()
	 * @return int[][]
	 */
	public function maskPatternProvider():array{
		return [[0], [1], [2], [3], [4], [5], [6], [7]];
	}

	/**
	 * Tests initializing the data matrix
	 *
	 * @dataProvider maskPatternProvider
	 */
	public function testInitMatrix(int $maskPattern):void{
		$this->QRData->setData([new $this->FQN($this->testdata)]);

		$matrix = $this->QRData->writeMatrix(new MaskPattern($maskPattern));

		$this::assertInstanceOf(QRMatrix::class, $matrix);
		$this::assertSame($maskPattern, $matrix->maskPattern()->getPattern());
	}

	/**
	 * Tests getting the minimum QR version for the given data
	 */
	public function testGetMinimumVersion():void{
		$this->QRData->setData([new $this->FQN($this->testdata)]);

		$getMinimumVersion = $this->reflection->getMethod('getMinimumVersion');
		$getMinimumVersion->setAccessible(true);
		/** @var \chillerlan\QRCode\Common\Version $version */
		$version = $getMinimumVersion->invoke($this->QRData);

		$this::assertInstanceOf(Version::class, $version);
		$this::assertSame(1, $version->getVersionNumber());
	}

	abstract public function stringValidateProvider():array;

	/**
	 * Tests if a string is properly validated for the respective data mode
	 *
	 * @dataProvider stringValidateProvider
	 */
	public function testValidateString(string $string, bool $expected):void{
		/** @noinspection PhpUndefinedMethodInspection */
		$this::assertSame($expected, $this->FQN::validateString($string));
	}

	/**
	 * returns versions within the version breakpoints 1-9, 10-26 and 27-40
	 */
	public function versionBreakpointProvider():array{
		return ['1-9' => [7], '10-26' => [15], '27-40' => [30]];
	}

	/**
	 * Tests decoding a data segment from a given BitBuffer
	 *
	 * @dataProvider versionBreakpointProvider
	 */
	public function testDecodeSegment(int $version):void{
		$options = new QROptions;
		$options->version = $version;

		// invoke a datamode interface
		/** @var \chillerlan\QRCode\Data\QRDataModeInterface $datamodeInterface */
		$datamodeInterface = new $this->FQN($this->testdata);
		// invoke a QRData instance and write data
		$this->QRData = new QRData($options, [$datamodeInterface]);
		// get the filled bitbuffer
		$bitBuffer = $this->QRData->getBitBuffer();
		// read the first 4 bits
		$this::assertTrue($bitBuffer->read(4) === $datamodeInterface->getDataMode());
		// hanzi mode starts with a subset indicator
		if($datamodeInterface instanceof Hanzi){
			$this::assertTrue($bitBuffer->read(4) === Hanzi::GB2312_SUBSET);
		}
		// decode the data
		/** @noinspection PhpUndefinedMethodInspection */
		$this::assertSame($this->testdata, $this->FQN::decodeSegment($bitBuffer, $options->version));
	}

	/**
	 * Tests if an exception is thrown when the data exceeds the maximum version while auto detecting
	 */
	public function testGetMinimumVersionException():void{
		$this->expectException(QRCodeDataException::class);
		$this->expectExceptionMessage('data exceeds');

		$this->QRData->setData([new $this->FQN(str_repeat($this->testdata, 1337))]);
	}

	/**
	 * Tests if an exception is thrown on data overflow
	 */
	public function testCodeLengthOverflowException():void{
		$this->expectException(QRCodeDataException::class);
		$this->expectExceptionMessage('code length overflow');

		$this->QRData = new QRData(
			new QROptions(['version' => 4]),
			[new $this->FQN(str_repeat($this->testdata, 1337))]
		);
	}

	/**
	 * Tests if an exception is thrown when an invalid character is encountered
	 */
	public function testInvalidDataException():void{
		$this->expectException(QRCodeDataException::class);
		$this->expectExceptionMessage('invalid data');

		/** @phan-suppress-next-line PhanNoopNew */
		new $this->FQN('##');
	}

	/**
	 * Tests if an exception is thrown if the given string is empty
	 */
	public function testInvalidDataOnEmptyException():void{
		$this->expectException(QRCodeDataException::class);
		$this->expectExceptionMessage('invalid data');

		/** @phan-suppress-next-line PhanNoopNew */
		new $this->FQN('');
	}

}
