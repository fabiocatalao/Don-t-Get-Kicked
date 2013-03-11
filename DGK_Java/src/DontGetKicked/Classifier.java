/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package DontGetKicked;

import weka.core.Instances;

/**
 */
public class Classifier {

    String filePath;
    String filePathModels;
    MultipleClassifier classifier;

    public Classifier(String filePath) {
        this.filePath = filePath;
        this.filePathModels = filePath + "models/";
    }

    public int run(int vehicleID) throws Exception {
        classifier = loadlassModel("MultipleClassifier.model");
        int vehicleClass = carEvaluator(vehicleID);
        //carEvaluator();
        return vehicleClass;
    }

    public MultipleClassifier loadlassModel(String filename) throws Exception {
        MultipleClassifier c = (MultipleClassifier) weka.core.SerializationHelper.read(filePathModels + filename);
        return c;
    }

    public int carEvaluator(int vehicleId) throws Exception {
        double clsLabel = 0.0;
        MultipleClassifier voteClassifier = classifier;
        //voteClassifier.setCombinationRule(new SelectedTag(VoteDGK.MAX_RULE, VoteDGK.TAGS_RULES));
        DbReader dbReader = new DbReader();
        String sqlQuery = "SELECT * FROM dontgetkicked WHERE veiculoID=" + vehicleId;
        Instances unlabeled = dbReader.loadData(sqlQuery);
        unlabeled.deleteAttributeAt(0);
        unlabeled.setClassIndex(unlabeled.numAttributes() - 1);
        for (int i = 0; i < unlabeled.numInstances(); i++) {
            clsLabel = voteClassifier.classifyInstance(unlabeled.instance(i));
        }
        return (int) clsLabel;
    }
}
