/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package DontGetKicked;

import java.util.Random;
import weka.classifiers.Evaluation;
import weka.core.Instances;

/**
 *
 * @author fabio
 */
public class ModelTest {

    String filePath;
    String filePathModels;
    MultipleClassifier classifier;

    public ModelTest(String filePath) {
        this.filePath = filePath;
        this.filePathModels = filePath + "models/";
    }

    public void run() throws Exception {
        classifier = loadlassModel("MultipleClassifier.model");
        evaluate();
    }

    public MultipleClassifier loadlassModel(String filename) throws Exception {
        MultipleClassifier c = (MultipleClassifier) weka.core.SerializationHelper.read(filePathModels + filename);
        return c;
    }

    public void evaluate() throws Exception {
        DbReader dbReader = new DbReader();
        String sqlQuery = "SELECT * FROM dontgetkicked WHERE IsBadBuy!=3";
        //String sqlQuery = "SELECT * FROM dontgetkicked WHERE IsBadBuy!=3";

        Instances unlabeled = dbReader.loadData(sqlQuery);
        unlabeled.deleteAttributeAt(0);
        unlabeled.setClassIndex(unlabeled.numAttributes() - 1);

        Evaluation eval = new Evaluation(unlabeled);
        eval.crossValidateModel(classifier, unlabeled, 10, new Random(1));
        System.out.println(eval.toSummaryString());
        //System.out.println(eval.toClassDetailsString());
        System.out.println(eval.toMatrixString());
    }
}
