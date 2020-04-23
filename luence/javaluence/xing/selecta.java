package xing;

import java.io.IOException;
import java.nio.file.Paths;
import java.util.ArrayList;
import java.util.List;

import org.apache.lucene.analysis.standard.StandardAnalyzer;
import org.apache.lucene.document.Document;
import org.apache.lucene.index.DirectoryReader;
import org.apache.lucene.index.IndexReader;
import org.apache.lucene.index.IndexWriter;
import org.apache.lucene.queryparser.classic.MultiFieldQueryParser;
import org.apache.lucene.queryparser.classic.ParseException;
import org.apache.lucene.search.BooleanClause;
import org.apache.lucene.search.IndexSearcher;
import org.apache.lucene.search.Query;
import org.apache.lucene.search.ScoreDoc;
import org.apache.lucene.search.TopDocs;
import org.apache.lucene.search.highlight.Formatter;
import org.apache.lucene.search.highlight.Highlighter;
import org.apache.lucene.search.highlight.QueryScorer;
import org.apache.lucene.search.highlight.Scorer;
import org.apache.lucene.search.highlight.SimpleHTMLFormatter;
import org.apache.lucene.store.Directory;
import org.apache.lucene.store.FSDirectory;



public class selecta {


	public static void main(String[] args) throws IOException, ParseException {
        Directory fsDir = FSDirectory.open(Paths.get("./xing"));
        IndexReader reader = DirectoryReader.open(fsDir);
        IndexSearcher searcher = new IndexSearcher(reader);

        String[] queries = { "杨紫", "yangz*" };
        String[] fields = { "name", "name_py" };
        BooleanClause.Occur[] clauses = { BooleanClause.Occur.SHOULD, BooleanClause.Occur.SHOULD };
        Query query = MultiFieldQueryParser.parse(queries, fields, clauses, new StandardAnalyzer());

        TopDocs topDocs = searcher.search(query,14);
        ScoreDoc[] hits = topDocs.scoreDocs;
        for (ScoreDoc scoreDoc : hits) {
        	
        	if(scoreDoc.score >0.0){
        		Document document = searcher.doc(scoreDoc.doc);
        		System.out.println(document.get("id")+"--"+document.get("name")+"--"+document.get("name_py")+"--匹配得分->"+scoreDoc.score);
        	}
        }
    }       


}