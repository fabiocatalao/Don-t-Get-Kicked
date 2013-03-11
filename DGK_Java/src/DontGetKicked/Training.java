package DontGetKicked;

import java.io.IOException;
import weka.classifiers.Classifier;
import weka.classifiers.bayes.BayesNet;
import weka.classifiers.bayes.NaiveBayes;
import weka.classifiers.meta.AdaBoostM1;
import weka.classifiers.meta.Bagging;
import weka.classifiers.meta.Stacking;
import weka.core.Instances;
import weka.classifiers.trees.J48;
import weka.classifiers.trees.J48graft;


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author fabio
 */
public class Training {

    String filePath;
    String filePathModels;
    Instances insts;
    Classifier classTree;

    public Training(String filePath) {
        this.filePath = filePath;
        this.filePathModels = filePath + "models/";
    }

    public void run() {
        try {
            //Data loading
            insts = loadData();

            //Start
            System.out.println("Start of model training");

            //--J48
            System.out.println("-Training J48 Unprunning Model");
            Classifier classJ48unp = classifierJ48unp();
            System.out.println("-Training J48 Prunning SubTree Raising Model");
            Classifier classJ48pru = classifierJ48pru();
            //  System.out.println("-Training J48 Graft Model");
            //  Classifier classJ48graft = classifierJ48pru();
            //--Naive Bayes
            System.out.println("-Training Naive Bayes Model");
            Classifier classNB = classifierNaiveBayes();
            //--BayesNet
            System.out.println("-Training Bayes Net Model");
            Classifier classBN = classifierBayesNet();
            //--Bagging
            //  System.out.println("-Training Bagging Model");
            //  Classifier classBG = classifierBagging();
            //--Stacking
            System.out.println("-Training Stacking Model");
            Classifier classStack = classifierStack();
            //--AdaBoostM1
            System.out.println("-Training AdaBoostM1 Model");
            Classifier classAdaBoos = classifierAdaBoost();

            //MultipleClassifier
            System.out.println("-MultipleClassifier Model");
            Classifier[] classSet = new Classifier[6];
            classSet[0] = classJ48unp;
            classSet[4] = classJ48pru;
            classSet[1] = classBN;
            classSet[5] = classNB;
            classSet[2] = classStack;
            classSet[3] = classAdaBoos;
            MultipleClassifier classMultipleClassifier = classifierVode(classSet);
            saveClassModel(classMultipleClassifier, "MultipleClassifier.Model");
            //End
            System.out.println("End of models training");
        } catch (Exception ex) {
            System.out.println(ex.toString());
        }
    }

    private Instances loadData() throws Exception {
        DbReader dbReader = new DbReader();
        Instances instances = dbReader.loadData("SELECT * FROM dontgetkicked WHERE isbadbuy=1 or isbadbuy=0");
        instances.deleteAttributeAt(0);
        instances.setClassIndex(instances.numAttributes() - 1);
        return instances;
    }

    private MultipleClassifier classifierVode(Classifier[] classifiers) throws Exception {
        MultipleClassifier MultipleClassifier = new MultipleClassifier();
        MultipleClassifier.setClassifiers(classifiers);
        //MultipleClassifier.setCombinationRule(new SelectedTag(MultipleClassifier.MAJORITY_VOTING_RULE, MultipleClassifier.TAGS_RULES));
        MultipleClassifier.buildClassifier(insts);
        return MultipleClassifier;
    }

    private Classifier classifierJ48unp() throws Exception {
        Classifier classJ48 = new J48();
        String[] options = new String[1];
        options[0] = "-U -M 2";
        classJ48.setOptions(options);
        classJ48.buildClassifier(insts);
        return classJ48;
    }

    private Classifier classifierJ48graft() throws Exception {
        Classifier classJ48 = new J48graft();
        String[] options = new String[1];
        options[0] = "-U -M 2";
        classJ48.setOptions(options);
        classJ48.buildClassifier(insts);
        return classJ48;
    }

    private Classifier classifierJ48pru() throws Exception {
        Classifier classJ48 = new J48();
        String[] options = new String[1];
        options[0] = "-C 0.25 -M 2";
        classJ48.setOptions(options);
        classJ48.buildClassifier(insts);
        return classJ48;
    }

    private Classifier classifierBayesNet() throws Exception {
        Classifier classBN = new BayesNet();
        classBN.buildClassifier(insts);
        return classBN;
    }

    private Classifier classifierNaiveBayes() throws Exception {
        Classifier classNB = new NaiveBayes();
        classNB.buildClassifier(insts);
        return classNB;
    }

    private Classifier classifierAdaBoost() throws Exception {
        Classifier classAdaBoos = new AdaBoostM1();
        classAdaBoos.buildClassifier(insts);
        return classAdaBoos;
    }

    private Classifier classifierStack() throws Exception {
        Classifier classStack = new Stacking();
        classStack.buildClassifier(insts);
        return classStack;
    }

    private Classifier classifierBagging() throws Exception {
        Classifier classBG = new Bagging();
        String[] options = new String[1];
        options[0] = "-P 100 -S 1 -I 10 -W weka.classifiers.trees.REPTree -- -M 2 -V 0.0010 -N 3 -S 1 -L -1";
        classBG.setOptions(options);
        classBG.buildClassifier(insts);
        return classBG;
    }

    private void saveClassModel(Classifier classi, String filename) throws IOException, Exception {
        weka.core.SerializationHelper.write(filePathModels + filename, classi);
    }
}
