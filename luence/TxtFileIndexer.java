package TestLucene;
 
import java.io.File;
import java.io.FileReader;
import java.io.Reader;
import java.util.Date;
 
import org.apache.lucene.analysis.Analyzer;
import org.apache.lucene.analysis.standard.StandardAnalyzer;
import org.apache.lucene.document.Document;
import org.apache.lucene.document.Field;
import org.apache.lucene.index.IndexWriter;
import org.apache.lucene.index.Term;
import org.apache.lucene.search.Hits;
import org.apache.lucene.search.IndexSearcher;
import org.apache.lucene.search.TermQuery;
import org.apache.lucene.store.FSDirectory;
 
public class TxtFileIndexer ...{
 
    public String test() ...{
        return "test is ok hohoho";
    }
 
    /**//**
     * @param args
     */
    public String createIndex(String indexDir_path,String dataDir_path) throws Exception ...{
        String result = "";
        File indexDir = new File(indexDir_path);
        File dataDir = new File(dataDir_path);
        Analyzer luceneAnalyzer = new StandardAnalyzer();
        File[] dataFiles = dataDir.listFiles();
        IndexWriter indexWriter = new IndexWriter(indexDir,luceneAnalyzer,true);
        long startTime = new Date().getTime();
        for(int i=0; i < dataFiles.length; i++) ...{
            if(dataFiles[i].isFile() && dataFiles[i].getName().endsWith(".html")) ...{
                result += "Indexing file" + dataFiles[i].getCanonicalPath()+"<br />";
                Document document = new Document();
                Reader txtReader = new FileReader(dataFiles[i]);
                document.add(Field.Text("path",dataFiles[i].getCanonicalPath()));
                document.add(Field.Text("contents",txtReader));
                indexWriter.addDocument(document);
            }
        }
 
        indexWriter.optimize();
        indexWriter.close();
        long endTime = new Date().getTime();
 
        result += "It takes"+(endTime-startTime)
                + " milliseconds to create index for the files in directory "
                + dataDir.getPath();
        return result;
    }
 
    public String searchword(String ss,String index_path)  throws Exception  ...{
        String queryStr = ss;
        String result = "Result:<br />";
        //This is the directory that hosts the Lucene index
        File indexDir = new File(index_path);
        FSDirectory directory = FSDirectory.getDirectory(indexDir,false);
        IndexSearcher searcher = new IndexSearcher(directory);
        if(!indexDir.exists())...{
            result = "The Lucene index is not exist";
            return result;
        }
        Term term = new Term("contents",queryStr.toLowerCase());
        TermQuery luceneQuery = new TermQuery(term);
        Hits hits = searcher.search(luceneQuery);
        for(int i = 0; i < hits.length(); i++)...{
            Document document = hits.doc(i);
            result += "<br /><a href='getfile.php?w="+ss+"&f="+document.get("path")+"'>File: " + document.get("path")+"</a>\n";
        }
        return result;
    }
 
}