package com.meimeixia.lucene;

import java.io.IOException;
import java.nio.file.Paths;


import org.apache.lucene.analysis.Analyzer;
import org.apache.lucene.analysis.standard.StandardAnalyzer;
import org.apache.lucene.document.Document;
import org.apache.lucene.document.Field;
import org.apache.lucene.document.TextField;
import org.apache.lucene.index.IndexWriter;
import org.apache.lucene.index.IndexWriterConfig;
import org.apache.lucene.store.Directory;
import org.apache.lucene.store.FSDirectory;

public class test {

    public static void main(String[] args) throws IOException {
    	
        Analyzer a = new StandardAnalyzer();
        Directory dir = FSDirectory.open(Paths.get("D:/workspace/luence/index"));
        IndexWriterConfig iwc = new IndexWriterConfig(a);
        IndexWriter iw = new IndexWriter(dir, iwc);
        Document doc = new Document();
        doc.add(new TextField("info", "luence", Field.Store.YES));
        iw.addDocument(doc);
        iw.close();
        dir.close();
    }

}