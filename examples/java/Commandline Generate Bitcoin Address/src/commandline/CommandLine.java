/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package commandline;

/*********
 * This is a Command line interface for the BitcoinAddress class
 * @author Gweedo
 *
 */
public class CommandLine {
/*********
 * This is the main method that generators a  Private Key, a Wallet Import Formatted Private key and a 
 * Bitcoin Address
 * @param args
 */
    public static void main(String[] args) {
        BitcoinAdress generator=new BitcoinAdress();
        String temp[]=generator.createNewAddress();
        System.out.println("Private key: "+temp[0]);
        System.out.println("WIF Private key: "+temp[1]);
        System.out.println("Bitcoin Address: "+temp[2]);
        }
}