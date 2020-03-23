package com.meimeixia.lucene;

import java.util.ArrayList;
import java.util.List;

import net.sf.json.JSONArray;
import net.sf.json.JSONObject;


public class b {
	public static void main(String[] args) {
	
		List<UserInfo> studentList = new ArrayList<UserInfo>();
		//JSONArray studentJsonArray = new JSONArray();
		

		studentList.add(new UserInfo("15","John"));
		studentList.add(new UserInfo("332","dsad"));
		JSONArray jsonarray = JSONArray.fromObject(studentList);
		System.out.println(jsonarray);
		//[{title='John', id=16}, {title='John', id=136}]
		/*
		[{
			"title": "as",
			"id": "269"
		}]
		 */
		
	}
}
