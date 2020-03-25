package com.meimeixia.lucene;

public class UserInfo{
    
	
    private String id;
    private String title;
    

    public UserInfo(String id,String title) {
    	super();
        this.title = title;
        this.id = id;
    }
    
	public String getTitle() {
		return title;
	}
	public void setTitle(String title) {
		this.title = title;
	}
	public String getId() {
		return id;
	}
	public void setId(String id) {
		this.id = id;
	}
	public String toString() {
		  return "{" +
	                "title='" + title + '\'' +
	                ", id=" + id +'}';
	}

    
}
