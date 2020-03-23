package com.meimeixia.lucene;

import java.util.ArrayList;

import net.sf.json.JSONArray;

public class a {
	public static void main(String[] args) {
	
		ArrayList<UserInfo> studentList = new ArrayList<UserInfo>();
		//JSONArray studentJsonArray = new JSONArray();
		

		studentList.add(new UserInfo("John","16"));
		studentList.add(new UserInfo("John","136"));
		System.out.println(studentList);
		//[{title='John', id=16}, {title='John', id=136}]
		/*
		[{
			"title": "【d】【完】 sa",
			"id": "269"
		}]
		 */
		
	}
}
