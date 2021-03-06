<?php
/**
 * @package     Joomla.UnitTest
 * @subpackage  User
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

/**
 * Test class for JUser.
 * Generated by PHPUnit on 2012-01-22 at 02:37:10.
 *
 * @package     Joomla.UnitTest
 * @subpackage  User
 * @since       12.1
 */
class JUserTest extends JoomlaDatabaseTestCase
{
	/**
	 * @var    JUser
	 * @since  12.1
	 */
	protected $object;

	/**
	 * Sets up the fixture.
	 *
	 * This method is called before a test is executed.
	 *
	 * @return  void
	 *
	 * @since   12.1
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->object = new JUser('42');

		// Ensure we have JComponentHelper (needed in case class is tested in isolation)
		jimport('joomla.application.component.helper');
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     PHPUnit_Framework_TestCase::tearDown()
	 * @since   12.1
	 */
	protected function tearDown()
	{
		$this->restoreFactoryState();

		parent::tearDown();
	}

	/**
	 * Gets the data set to be loaded into the database during setup
	 *
	 * @return  xml dataset
	 *
	 * @since   12.1
	 */
	protected function getDataSet()
	{
		return $this->createXMLDataSet(__DIR__ . '/JUserTest.xml');
	}

	/**
	 * Test cases for getInstance
	 *
	 * @return  array
	 *
	 * @since   12.1
	 */
	function casesGetInstance()
	{
		return array(
			'42' => array(
				42,
				'JUser'
			),
			'99' => array(
				99,
				'JUser'
			)
		);
	}

	/**
	 * Tests JUser::getInstance().
	 *
	 * @param   mixed  $userid    User ID or name
	 * @param   mixed  $expected  User object or false if unknown
	 *
	 * @return  void
	 *
	 * @since   12.1
	 *
	 * @dataProvider casesGetInstance
	 */
	public function testGetInstance($userid, $expected)
	{
		$user = JUser::getInstance($userid);
		$this->assertThat(
			$user,
			$this->isInstanceOf($expected)
		);
	}

	/**
	 * Tests JUser Parameter setting and retrieval.
	 *
	 * @return  void
	 *
	 * @since   12.1
	 *
	 * @covers JUser::defParam
	 * @covers JUser::getParam
	 * @covers JUser::setParam
	 */
	public function testParameter()
	{
		$this->assertThat(
			$this->object->getParam('holy', 'fred'),
			$this->equalTo('fred')
		);

		$this->object->defParam('holy', 'batman');
		$this->assertThat(
			$this->object->getParam('holy', 'fred'),
			$this->equalTo('batman')
		);

		$this->object->setParam('holy', 'batman');
		$this->assertThat(
			$this->object->getParam('holy', 'fred'),
			$this->equalTo('batman')
		);
	}

	/**
	 * Test cases for testAuthorise
	 *
	 * @return  array
	 *
	 * @since   12.1
	 */
	function casesAuthorise()
	{
		return array(
			'Publisher Create' => array(
				43,
				'core.create',
				'com_content',
				true
			),
			'null asset Super Admin' => array(
				42,
				'core.create',
				null,
				true
			),
			'fictional action Super Admin' => array(
				42,
				'nuke',
				'root.1',
				true
			),
			'core.admin Other user' => array(
				43,
				'core.admin',
				'root.1',
				false
			),
			'core.admin Super Admin' => array(
				42,
				'core.admin',
				'root.1',
				true
			)
		);
	}

	/**
	 * Tests JUser::authorise().
	 *
	 * @param   integer  $userId    User id of user to test
	 * @param   string   $action    Action to get aithorized for this user
	 * @param   string   $asset     Asset to get authorization for
	 * @param   boolean  $expected  Expected return from the authorization check
	 *
	 * @return  void
	 *
	 * @since   12.1
	 *
	 * @dataProvider  casesAuthorise
	 */
	public function testAuthorise($userId, $action, $asset, $expected)
	{
		// Run through test cases
		$user = new JUser($userId);
		$this->assertThat(
			$user->authorise($action, $asset),
			$this->equalTo($expected),
			'Line: '. __LINE__ . ' Failed for user ' . $user->id
		);

	}

	/**
	 * @covers JUser::getAuthorisedCategories
	 * @todo Implement testGetAuthorisedCategories().
	 */
	public function testGetAuthorisedCategories()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * Test cases for testGetAuthorisedViewLevels
	 *
	 * @return  array
	 *
	 * @since   12.1
	 */
	function casesGetAuthorisedViewLevels()
	{
		return array(
			'User42' => array(
				null,
				array(1, 3)
			),
			'User43' => array(
				43,
				array(1, 2)
			),
			'User99' => array(
				99,
				array(1, 4)
			)
		);
	}

	/**
	 * Tests JUser::getAuthorisedViewLevels().
	 *
	 * @param   integer  $user      User id of user to test
	 * @param   array    $expected  Authorized levels of use
	 *
	 * @return  void
	 *
	 * @since   12.1
	 *
	 * @dataProvider  casesGetAuthorisedViewLevels
	 */
	public function testGetAuthorisedViewLevels($user, $expected)
	{
		if ($user)
		{
			$user = new JUser($user);
		}
		else
		{
			$user = $this->object;
		}

		$this->assertThat(
			$user->getAuthorisedViewLevels(),
			$this->equalTo($expected),
			'Failed for user ' . $user->id
		);
	}

	/**
	 * @covers JUser::getAuthorisedGroups
	 * @todo Implement testGetAuthorisedGroups().
	 */
	public function testGetAuthorisedGroups()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * Tests JUser::getAuthorisedViewLevels().
	 *
	 * @return  void
	 *
	 * @since   12.1
	 */
	public function testSetLastVisit()
	{
		$timestamp = '2012-01-22 02:00:00';

		$this->object->setLastVisit($timestamp);
		$testUser = new JUser(42);
		$this->assertThat(
			$testUser->lastvisitDate,
			$this->equalTo($timestamp)
		);
	}

	/**
	 * Tests JUser::getAuthorisedViewLevels().
	 *
	 * @return  void
	 *
	 * @deprecated  12.3
	 */
	public function testGetParameters()
	{
		// Remove the following lines when you implement this test.
		$this->markTestSkipped(
			'This method is deprecated.'
		);
	}

	/**
	 * @covers JUser::setParameters
	 * @todo Implement testSetParameters().
	 */
	public function testSetParameters()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers JUser::getTable
	 * @todo Implement testGetTable().
	 */
	public function testGetTable()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers JUser::bind
	 * @todo Implement testBind().
	 */
	public function testBind()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers JUser::save
	 * @todo Implement testSave().
	 */
	public function testSave()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * @covers JUser::delete
	 * @todo Implement testDelete().
	 */
	public function testDelete()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
		  'This test has not been implemented yet.'
		);
	}

	/**
	 * Test cases for testLoad
	 *
	 * @return  array
	 *
	 * @since   12.1
	 */
	function casesLoad()
	{
		return array(
			'existing' => array(
				42,
				true
			)
		);
	}

	/**
	 * Tests JUser::load().
	 *
	 * @param   integer  $id        User ID to load
	 * @param   boolean  $expected  Expected result of load operation
	 *
	 * @return  void
	 *
	 * @since   12.1
	 *
	 * @dataProvider casesLoad
	 */
	public function testLoad($id, $expected)
	{
		$testUser = new JUser($id);

		$this->assertThat(
			$testUser->load($id),
			$this->equalTo($expected)
		);
	}
}
