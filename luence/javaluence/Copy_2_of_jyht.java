package com.meimeixia.lucene;

import net.sf.json.JSONArray;

import org.apache.lucene.analysis.Analyzer;
import org.apache.lucene.analysis.standard.StandardAnalyzer;
import org.apache.lucene.document.Document;
import org.apache.lucene.document.Field;
import org.apache.lucene.document.TextField;
import org.apache.lucene.index.DirectoryReader;
import org.apache.lucene.index.IndexReader;
import org.apache.lucene.index.IndexWriter;
import org.apache.lucene.index.IndexWriterConfig;
import org.apache.lucene.queryparser.classic.QueryParser;
import org.apache.lucene.search.IndexSearcher;
import org.apache.lucene.search.Query;
import org.apache.lucene.search.ScoreDoc;
import org.apache.lucene.search.TopDocs;
import org.apache.lucene.store.Directory;
import org.apache.lucene.store.FSDirectory;
import java.util.ArrayList;

import java.nio.file.Paths;
import java.sql.*;
import java.util.ArrayList;

public class Copy_2_of_jyht {
	// MySQL 8.0 以下版本 - JDBC 驱动名及数据库 URL
    static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
    static final String DB_URL = "jdbc:mysql://localhost:3306/av";
 
    // MySQL 8.0 以上版本 - JDBC 驱动名及数据库 URL
    //static final String JDBC_DRIVER = "com.mysql.cj.jdbc.Driver";  
    //static final String DB_URL = "jdbc:mysql://localhost:3306/RUNOOB?useSSL=false&serverTimezone=UTC";
 
 
    // 数据库的用户名与密码，需要根据自己的设置
    static final String USER = "root";
    static final String PASS = "";
    
    public void insert() {
        Connection conn = null;
        Statement stmt = null;
        try{
            // 注册 JDBC 驱动
            Class.forName(JDBC_DRIVER);
        
            // 打开链接
            conn = DriverManager.getConnection(DB_URL,USER,PASS);
        
            // 执行查询
            stmt = conn.createStatement();
            String sql = "SELECT * FROM article limit 0,100";
            ResultSet rs = stmt.executeQuery(sql);
            //后加的start
            Analyzer a = new StandardAnalyzer();
            Directory dir = FSDirectory.open(Paths.get("./index"));
            IndexWriterConfig iwc = new IndexWriterConfig(a);
            IndexWriter iw = new IndexWriter(dir, iwc);
            //后加end
            // 展开结果集数据库
            while(rs.next()){
            	 Document doc = new Document();
                // 通过字段检索
            	String id  = rs.getString("id");
                String title = rs.getString("title");
                doc.add(new TextField("id", id, Field.Store.YES));
                doc.add(new TextField("title", title, Field.Store.YES));
                iw.addDocument(doc);
                // 输出数据
                //System.out.print("ID: " + id);
                //System.out.print(", 站点名称: " + name);
                //System.out.print(", 站点 URL: " + url);
                //System.out.print("\n");
            }
            // 完成后关闭
            rs.close();
            stmt.close();
            conn.close();
            iw.close();
            dir.close();
        }catch(SQLException se){
            // 处理 JDBC 错误
            se.printStackTrace();
        }catch(Exception e){
            // 处理 Class.forName 错误
            e.printStackTrace();
        }finally{
            // 关闭资源
            try{
                if(stmt!=null) stmt.close();
            }catch(SQLException se2){
            }// 什么都不做
            try{
                if(conn!=null) conn.close();
            }catch(SQLException se){
                se.printStackTrace();
            }
        }
        //System.out.println("Goodbye!");
    }
    
    public String search(String keyword,int page) {
         String result = "";
         try {
         	Analyzer a = new StandardAnalyzer();
            Directory dir = FSDirectory.open(Paths.get("./index"));
            IndexReader reader = DirectoryReader.open(dir);
            IndexSearcher is = new IndexSearcher(reader);
            QueryParser parser = new QueryParser("title", a);
            Query query = parser.parse(keyword);
            TopDocs topDocs = is.search(query, page*15);
            //System.out.println("总共匹配多少个：" + topDocs.totalHits);
            ScoreDoc[] hits = topDocs.scoreDocs;
            // 应该与topDocs.totalHits相同
            //System.out.println("多少条数据：" + hits.length);
           // ArrayList 	<UserInfo> usersa=new  ArrayList<UserInfo>();
            ArrayList<String> users=new  ArrayList<String>();
            for (ScoreDoc scoreDoc : hits) {
                //System.out.println("匹配得分：" + scoreDoc.score);
                //System.out.println("文档索引ID：" + scoreDoc.doc);
                Document document = is.doc(scoreDoc.doc);
                //System.out.println(document.get("id")+"---"+document.get("title"));
                users.add(document.get("title"));
            }
    		System.out.println(users);
            reader.close();
            dir.close();
            String str = "jyht1"+users;
            return str;
            
         } catch (Exception e) {
             return e.getMessage();
         }
         
  
    }
    
    
    
}
