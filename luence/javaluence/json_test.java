package com.meimeixia.lucene;

import java.util.Iterator;

import net.sf.json.JSONArray;
import net.sf.json.JSONObject;




public class json_test {
	public static void main(String[] args){
		
		String str = "{\"userName\":\"mengHeng\",\"hoby\":\"写百度经验\"}";
		JSONObject jsonObj = JSONObject.fromObject(str); 
		Iterator iterator = jsonObj.keys();
		while(iterator.hasNext()){

		    String key = (String) iterator.next();

		    String value = jsonObj.getString(key);

		    System.out.println(key + " : " + value);
		}
	}
	
	public void json_array (){
		String[] arr = {"asd","dfgd","asd","234"};

		JSONArray jsonarray = JSONArray.fromObject(arr);

		System.out.println(jsonarray);
	}		
}
