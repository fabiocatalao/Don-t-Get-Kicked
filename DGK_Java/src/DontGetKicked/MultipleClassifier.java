/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package DontGetKicked;

import java.util.Random;
import weka.classifiers.RandomizableMultipleClassifiersCombiner;
import weka.core.Instance;
import weka.core.Instances;
import weka.core.TechnicalInformation;
import weka.core.TechnicalInformationHandler;

/**
 *
 * @author fabio
 */
public class MultipleClassifier extends RandomizableMultipleClassifiersCombiner implements TechnicalInformationHandler {

    protected Random m_Random;

    @Override
    public void buildClassifier(Instances data) throws Exception {
        // can classifier handle the data?
        getCapabilities().testWithFail(data);
        // remove instances with missing class
        Instances newData = new Instances(data);
        newData.deleteWithMissingClass();
        m_Random = new Random(getSeed());
        for (int i = 0; i < m_Classifiers.length; i++) {
            getClassifier(i).buildClassifier(newData);
        }
    }

    @Override
    public double classifyInstance(Instance instance) throws Exception {
        double result = 0.0;

        double auxResult = 0.0;
        boolean findBad = false;
        for (int i = 0; i < m_Classifiers.length; i++) {
            try {
                auxResult = m_Classifiers[i].classifyInstance(instance);
            } catch (Exception e) {
            }
            if (auxResult == 1.0) {
                findBad = true;
            }
        }
        if (findBad == true) {
            result = 1.0;
        }
        return result;
    }

    @Override
    public TechnicalInformation getTechnicalInformation() {
        throw new UnsupportedOperationException("Not supported yet.");
    }
}
