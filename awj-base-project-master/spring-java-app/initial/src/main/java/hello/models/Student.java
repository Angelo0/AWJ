package hello;

public class Student {

    private long id;
    private String nume;
    private  long an;
    private String serie;

    public Student() {}

    public Student(long id, String nume,long an, String serie) 
    {
        this.id = id;
        this.nume = nume;
        this.an = an;
        this.serie = serie;
    }

   public long getId() 
    {
        return id;
    }

    public String getNume() 
    {
        return nume;
    }

    public long getAn() 
    {
        return an;
    }

    public String getSerie() 
    {
        return serie;
    }

    public void setId( long id) 
    {
        this.id = id;
    }
    
    public void setNume( String nume) 
    {
        this.nume = nume;
    }
}