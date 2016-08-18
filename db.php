<?
/***
/*
/* Basic JSON database class
/* (c) 2016 by Plamen Kozhuharov
/*
/*/

class Db {

	var $db_file = 'patients.db',
	$dataArr = array(),
	$sizeof,
	$num_rows = 0,
	$where = array(),
	$like = array(),
	$pointer;

	function __construct()
	{
		$this->get();
		
		$this->do_indexing();
		
	}
	
	private function do_where()
	{
		// Where Filter
		if( ! empty( $this->where ) )
		{
			$result = array();
			foreach( $this->dataArr as $row )
			{
				foreach( $this->where as $key => $value )
				{
					if( $row[ $key ] == $value ) $result[] = $row;
				}
			}
			
			$this->where = array();
			$this->dataArr = $result;
		}
	}
	
	private function do_like()
	{
		// Like Filter
		if( ! empty( $this->like ) )
		{
			$result = array();
			
			foreach( $this->dataArr as $row )
			{
				foreach( $this->like as $key => $value )
				{
					if( strpos( $row[ $key ], $value ) != FALSE ) $result[] = $row;
				}
			}
			
			$this->like = array();
			$this->dataArr = $result;
		}
	}
	
	private function do_indexing()
	{
		if( ! empty( $this->dataArr ) )
		{
			$i = 1;
			foreach( $this->dataArr as $key => $value )
			{
				$this->dataArr[ $key ][ '_id' ] = $i;
				$i++;
			}
		}
	}
	
	private function clear_indexing()
	{
		foreach( $this->dataArr as $key => $value )
		{
			unset( $this->dataArr[ $key ][ '_id' ] );
		}
	}
	
	/***
	/*
	/*		CLASS INTERFACE METHODS
	/*
	/*/
	
	public function where( $key, $value )
	{
		$this->where[$key] = $value;
	}
	
	public function like( $key, $value )
	{
		$this->like[$key] = $value;
	}

	public function get()
	{
		$this->dataArr = json_decode( @file_get_contents( $this->db_file ), TRUE );
		
		// Apply filtering
		$this->do_where();
		$this->do_like();
		
		// Set num_rows
		if( empty( $this->dataArr) ) $this->num_rows = 0;
		else $this->num_rows = sizeof( $this->dataArr );
		
		return $this->dataArr;
	}
	
	public function insert( $data )
	{
		$this->dataArr[] = $data;
		$this->do_indexing();
		$json = json_encode( $this->dataArr );
		@file_put_contents( $this->db_file, $json );
	}
	
	public function update( $data )
	{
		$rows = $this->get(); // First query, will reset WHERE and LIKE
		$rows_full = $this->get();
		
		foreach( $rows as $row )
		{
			foreach( $data as $key => $value )
			{
				$row[ $key ] = $value;
			}	
			
			foreach( $rows_full as $key => $value )
			{
				if( $rows_full[ $key ][ '_id' ] == $row[ '_id' ] )
				{
					$rows_full[ $key ] = $row;
				}
			}
		}
		
		$this->dataArr = $rows_full;
		$json = json_encode( $this->dataArr );
		@file_put_contents( $this->db_file, $json );
	}



}