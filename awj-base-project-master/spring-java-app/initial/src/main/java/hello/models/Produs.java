package hello;

public class Produs{

    private long id;
    private String denumire;
    private long an_fabr;

    public Produs() {}

    public Produs(long id, String denumire, long an_fabr) 
    {
        this.id = id;
        this.denumire = denumire;
        this.an_fabr = an_fabr;
    }

    public long getId() 
    {
        return id;
    }

    public String getDenumire() 
    {
        return denumire;
    }

    public long getAn() 
    {
        return an_fabr;
    }

    public void setId( long id) 
    {
        this.id = id;
    }

    public void setDenumire( String denumire) 
    {
         this.denumire = denumire;
    }

    public void setAn(long an_fabr) 
    {
         this.an_fabr = an_fabr;
    }

}