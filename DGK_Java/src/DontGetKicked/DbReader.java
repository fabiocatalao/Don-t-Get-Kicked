/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package DontGetKicked;

import java.util.logging.Level;
import java.util.logging.Logger;
import weka.core.Instances;
import weka.experiment.InstanceQuery;

/**
 *
 * @author fabio
 */
public class DbReader {

    public void bdReader() {
    }

    public Instances loadData(String queryMsg) throws Exception {
        InstanceQuery query = new InstanceQuery();
        //query.setDatabaseURL();
        query.setUsername("root");
        query.setPassword("");
        query.setQuery(queryMsg);
        // You can declare that your data set is sparse
        // query.setSparseData(true);
        Instances data = query.retrieveInstances();
        //System.out.append(data.toString());
        return data;
    }
}
