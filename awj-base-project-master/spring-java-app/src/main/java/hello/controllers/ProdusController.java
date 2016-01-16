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
public class ProdusController {
  private ArrayList<Produs> prod = new ArrayList<Produs>();

  ProdusController() {
    Produs p1 = new Produs(1, "Produs1", 1994);
    Produs p2 = new Produs(2, "Produs2", 2007);
    Produs p3 = new Produs(3, "Produs3", 2015);

    prod.add(p1);
    prod.add(p2);
    prod.add(p3);
  }

  @RequestMapping(value="/produs", method = RequestMethod.GET)
  public ArrayList<Produs> index() {
    return this.prod;
  }

  @RequestMapping(value="/produs/{id}", method = RequestMethod.GET)
  public ResponseEntity show(@PathVariable("id") int id) {
    for(Produs p : this.prod) {
      if(p.getId() == id) {
        return new ResponseEntity<Produs>(p, new HttpHeaders(), HttpStatus.OK);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }

  @RequestMapping(value="/produs/{id}/{denumire}/{an}", method = RequestMethod.POST)
  public ResponseEntity add(@PathVariable("id") int id,
                                   @PathVariable("denumire") String denumire,
                                   @PathVariable("an") int an) {
    Produs p = new Produs(id, denumire, an);
    this.prod.add(p);
    return new ResponseEntity<Produs>(p, new HttpHeaders(), HttpStatus.OK);
  }

@RequestMapping(value="/produs/{id}/{an}", method = RequestMethod.PUT)
  public ResponseEntity update(@PathVariable("id") int id,
                               @PathVariable("an") int an) {
 for(Produs p : this.prod) {
      if(p.getId() == id) 
       {
        p.setAn(an);
        return new ResponseEntity<Produs>(p, new HttpHeaders(), HttpStatus.OK);
       }

    }
     return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
}



  @RequestMapping(value="/produs/{id}", method = RequestMethod.DELETE)
  public ResponseEntity remove(@PathVariable("id") int id) {
    for(Produs p : this.prod) {
      if(p.getId() == id) {
        this.prod.remove(p);
        return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NO_CONTENT);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }


}