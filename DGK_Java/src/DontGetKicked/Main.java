package DontGetKicked;

public class Main {

    private static String filePath = "D:/DontGetKicked/";

    /*
     * Don't Get Kicked Main 
     */
    public static void main(String[] args) throws Exception {
        if (args.length > 0) {
            String op = args[0];
            /* Classificação */
            if (op.equals("evaluate")) {
                if (args.length == 2) {
                    int vehicleId = Integer.parseInt(args[1]);
                    Classifier classif = new Classifier(filePath);
                    int vehClass = classif.run(vehicleId);
                    System.out.println("evaluation:vehicle" + vehicleId + ";classification" + vehClass);
                }
            }
            /* Treino */
            if (op.equals("training")) {
                System.out.println("Dont get Kicked - Training Mode");
                Training train = new Training(filePath);
                train.run();
            }
            /* Testar modelos */
            if (op.equals("testmodel")) {
                System.out.println("Dont get Kicked - ModelTest");
                ModelTest mtest = new ModelTest(filePath);
                mtest.run();
            }
        }
    }
}
