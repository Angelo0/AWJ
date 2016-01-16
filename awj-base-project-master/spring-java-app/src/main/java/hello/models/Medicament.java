package hello;


public class Medicament {

    private long id;
    private String denumire;
    private  String efect;

    public Medicament() {}

    public Medicament(long id, String denumire, String efect) 
    {
        this.id = id;
        this.denumire = denumire;
        this.efect = efect;
    }

   public long getId() 
    {
        return id;
    }

    public String getDenumire() 
    {
        return denumire;
    }

    public String getEfect() 
    {
        return efect;
    }

    public void setId( long id) 
    {
        this.id = id;
    }
    
    public void setDenumire( String denumire) 
    {
        this.denumire = denumire;
    }
}