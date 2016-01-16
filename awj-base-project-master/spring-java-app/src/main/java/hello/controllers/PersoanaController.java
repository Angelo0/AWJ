package hello;

import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import java.util.ArrayList;


@RestController
public class PersoanaController {
  private ArrayList<Persoana> pers = new ArrayList<Persoana>();

  PersoanaController() {
    Persoana p1 = new Persoana(1, "John", "MCcartney");
    Persoana p2 = new Persoana(2, "Paul", "Blurt");
    Persoana p3 = new Persoana(3, "Dan", "Bilzerian");

    pers.add(p1);
    pers.add(p2);
    pers.add(p3);
  }

  @RequestMapping(value="/persoana", method = RequestMethod.GET)
  public ArrayList<Persoana> index() {
    return this.pers;
  }

  @RequestMapping(value="/persoana/{id}", method = RequestMethod.GET)
  public ResponseEntity show(@PathVariable("id") int id) {
    for(Persoana p : this.pers) {
      if(p.getId() == id) {
        return new ResponseEntity<Persoana>(p, new HttpHeaders(), HttpStatus.OK);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }

  @RequestMapping(value="/persoana/{id}/{nume}/{prenume}", method = RequestMethod.POST)
  public ResponseEntity add(@PathVariable("id") int id,
                                   @PathVariable("nume") String nume,
                                   @PathVariable("prenume") String prenume) {
    Persoana p = new Persoana(id, nume, prenume);
    this.pers.add(p);
    return new ResponseEntity<Persoana>(p, new HttpHeaders(), HttpStatus.OK);
  }

@RequestMapping(value="/persoana/{id}/{nume}", method = RequestMethod.PUT)
  public ResponseEntity update(@PathVariable("id") int id,
                                @PathVariable("nume") String nume
                                ) {
 for(Persoana p : this.pers) {
      if(p.getId() == id) 
       {
        p.setNume(nume);
        return new ResponseEntity<Persoana>(p, new HttpHeaders(), HttpStatus.OK);
       }

    }
     return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
}



  @RequestMapping(value="/persoana/{id}", method = RequestMethod.DELETE)
  public ResponseEntity remove(@PathVariable("id") int id) {
    for(Persoana p : this.pers) {
      if(p.getId() == id) {
        this.pers.remove(p);
        return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NO_CONTENT);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }


}