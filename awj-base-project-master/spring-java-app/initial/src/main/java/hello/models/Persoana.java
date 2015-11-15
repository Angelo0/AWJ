package hello;

public class Persoana {

    private long id;
    private String nume;
    private String prenume;

    public Persoana() {}

    public Persoana(long id, String nume, String prenume) 
    {
        this.id = id;
        this.nume = nume;
        this.prenume = prenume;
    }

    public long getId() 
    {
        return id;
    }

     public String getNume() 
    {
        return nume;
    }

     public String getPrenume() 
    {
        return prenume;
    }
    

    public void setNume( String nume) 
    {
         this.nume = nume;
    }



}