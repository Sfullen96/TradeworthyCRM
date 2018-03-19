<?php
require_once '../../core/init.php';
include '../../includes/header.php';
?>
<h3> Properties </h3>
<table class="table table-hover dataTable">
	<thead>
		<tr>
			<th> Property Name </th>
			<th> Method Type </th>
			<th> Description </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> $_instance </td>
			<td> private static </td>
			<td> Stores an instance of this class </td>
		</tr>
		<tr>
			<td> $_pdo </td>
			<td> private </td>
			<td> Stores the PDO object once instantiated </td>
		</tr>
		<tr>
			<td> $_query </td>
			<td> private </td>
			<td> Stores the last executed query </td>
		</tr>
		<tr>
			<td> $_error </td>
			<td> private </td>
			<td> Set to false by default </td>
		</tr>
		<tr>
			<td> $_results </td>
			<td> private </td>
			<td> Stores the results set of a query </td>
		</tr>
		<tr>
			<td> $_count </td>
			<td> private </td>
			<td> Set to 0 by default, stores the number of rows returned by a query </td>
		</tr>
		<tr>
			<td> $_sql </td>
			<td> private </td>
			<td> Stores a string which is used to run a query </td>
		</tr>
		<tr>
			<td> $_params </td>
			<td> private </td>
			<td> Stores an array of parameters for a query </td>
		</tr>
		<tr>
			<td> $_paramCount </td>
			<td> private </td>
			<td> Stores how many paramers are on the current query, used to change WHERE to AND on secondary where statements </td>
		</tr>
	</tbody>
</table>
<h3> Methods </h3>
<table class="table table-hover dataTable">
	<thead>
		<tr>
			<th> Method Name </th>
			<th> Method Type </th>
			<th> Parameters </th>
			<th> Returns </th>
			<th> Description </th>
			<th> Usage </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td> __construct() </td>
			<td> __construct() </td>
			<td> N/A </td>
			<td> N/A </td>
			<td> Connects to mysql </td>
			<td> N/A </td>
		</tr>
		<tr>
			<td> getInstance </td>
			<td> public static </td>
			<td> N/A </td>
			<td> self::$_instance </td>
			<td> Checks if $_instance is set, if not sets $_insance = to a new object of this class, which in turn calls the constructor which sets up the PDO connection </td>
			<td> Used to get an instance of DB class </td>
		</tr>
		<tr>
			<td> select </td>
			<td> public </td>
			<td> $table - to select from, $select = array() - what to select from said tables, optional parameter, leave blank to select all </td>
			<td> Returns $this </td>
			<td> The first method in the select method chain, used to create the first part of the $_sql string SELECT fields FROM table </td>
			<td> Usually used within other classes like so: $this->_sql->select('table', array('field', 'field')) - This is useless without chaining ->get(); <br> Can also be used like this: DB::getInstance()->select('table', 'fields')</td>
		</tr>
		<tr>
			<td> where </td>
			<td> public </td>
			<td> $where = array() </td>
			<td> $this </td>
			<td> Cannot be used on it's own, must be chained onto select(), used to add a where statement to $_sql to be executed as a query later. </td>
			<td> DB::getInstance()->select('table', array('fields'))->where(array('field', 'operator', 'value'))->get(); </td>
		</tr>
		<tr>
			<td> join </td>
			<td> public </td>
			<td> $type, $table, $on = array() </td>
			<td> $this </td>
			<td> Cannot be used on it's own, must be chained onto select(), used to join another table on a query. Type can be defined, i.e. left, inner etc. </td>
			<td> DB::getInstance()->select('table', array('fields'))->join('type', 'table', array('table.field', '=', 'othertable.field'))->get(); </td>
		</tr>
		<tr>
			<td> orderBy </td>
			<td> public </td>
			<td> $clause </td>
			<td> $this </td>
			<td> Cannot be used on it's own, must be chained onto another method in the query chain (select, join, where), used to add an order by clause to $_sql. </td>
			<td> DB::getInstance()->select('table', array('fields'))->orderBy('field ASC/DESC')->get(); </td>
		</tr>
		<tr>
			<td> limit </td>
			<td> public </td>
			<td> $limit </td>
			<td> $this </td>
			<td> Cannot be used on it's own, must be chained onto another method in the query chain (select, join, where), used to add a limit clause to $_sql. </td>
			<td> DB::getInstance()->select('table', array('fields'))->limit(integer)->get(); </td>
		</tr>
		<tr>
			<td> get </td>
			<td> public </td>
			<td> None </td>
			<td> $this->query($_sql, $_params) </td>
			<td> Only used as the last method in the query method chain, passes the $_sql string and any $_params to the query() method </td>
			<td> DB::getInstance()->select('table', array('fields'))->limit(integer)->get(); </td>
		</tr>
		<tr>
			<td> query </td>
			<td> public </td>
			<td> $sql, $params = array() - optional parameter </td>
			<td> $this </td>
			<td> Checks if the query can be prepared correctly in order to be executed, then runs the query itself </td>
			<td> Can be used directly but no reccomended, it's called by other methods such as get(), update() and delete(). </td>
		</tr>
		<tr>
			<td> rawQuery </td>
			<td> public </td>
			<td> $sql </td>
			<td> $this </td>
			<td> If it's ever needed just to execute a raw query, simply pass an SQL string through. </td>
			<td> DB::getInstance()->rawQuery("SQL string"); </td>
		</tr>
		<tr>
			<td> insert </td>
			<td> public </td>
			<td> $table, $fields = array() </td>
			<td> true if query is executed, false if not </td>
			<td> Used to insert a row into the database. </td>
			<td> DB::getInstance()->insert('table', keyValueArray('field' => 'value')) </td>
		</tr>
		<tr>
			<td> update </td>
			<td> public </td>
			<td> $table, $where </td>
			<td> true if query executed, false if not </td>
			<td> Used to update row(s) in the database </td>
			<td> DB::getInstance()->update('table', array('field', 'operator', 'value')) </td>
		</tr>
		<tr>
			<td> delete </td>
			<td> public </td>
			<td> $table, $where </td>
			<td> true if query executed, false if not </td>
			<td> Used to delete row(s) in the database </td>
			<td> DB::getInstance()->delete('table', array('field', 'operator', 'value')) </td>
		</tr>
		<tr>
			<td> results </td>
			<td> public </td>
			<td> N/A </td>
			<td> $_results </td>
			<td> Returns the results set of the most recently executed query. </td>
			<td> DB::getInstance()->select('table')->get()->results(); </td>
		</tr>
		<tr>
			<td> first </td>
			<td> public </td>
			<td> N/A </td>
			<td> $this->$_results()[0] </td>
			<td> Returns the first row of the most recently executed query. </td>
			<td> DB::getInstance()->select('table')->get()->first(); </td>
		</tr>
		<tr>
			<td> error </td>
			<td> public </td>
			<td> N/A </td>
			<td> $this->$error </td>
			<td> Returns any errors with queries. </td>
			<td> N/A </td>
		</tr>
		<tr>
			<td> count </td>
			<td> public </td>
			<td> N/A </td>
			<td> $this->$_count </td>
			<td> Returns the rowCount() of the most recent query. </td>
			<td> Most comonly used to check if any rows were returned from a query </td>
		</tr>
		<tr>
			<td> lastInsertId </td>
			<td> public </td>
			<td> N/A </td>
			<td> $this->$_pdo->lastInsertId(); </td>
			<td> Returns the last inserted ID from the PDO object. </td>
			<td> Returns the last inserted ID from the PDO object. </td>
		</tr>
	</tbody>
</table>
<?php include '../../includes/footer.php'; ?>