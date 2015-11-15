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
public class MedicamentController {
  private ArrayList<Medicament> med = new ArrayList<Medicament>();

  MedicamentController() {

    
    Medicament p1 = new Medicament(1, "Medicament1", "mancarime");
    Medicament p2 = new Medicament(2, "Medicament2", "apetit scazut");
    Medicament p3 = new Medicament(3, "Medicament3", "greata");

    med.add(p1);
    med.add(p2);
    med.add(p3);
  }

  @RequestMapping(value="/medicament", method = RequestMethod.GET)
  public ArrayList<Medicament> index() {
    return this.med;
  }

  @RequestMapping(value="/medicament/{id}", method = RequestMethod.GET)
  public ResponseEntity show(@PathVariable("id") int id) {
    for(Medicament p : this.med) {
      if(p.getId() == id) {
        return new ResponseEntity<Medicament>(p, new HttpHeaders(), HttpStatus.OK);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }

  @RequestMapping(value="/medicament/{id}/{denumire}/{efect}", method = RequestMethod.POST)
  public ResponseEntity add(@PathVariable("id") int id,
                                   @PathVariable("denumire") String denumire,
                                   @PathVariable("efect") String efect) {
    Medicament p = new Medicament(id, denumire, efect);
    this.med.add(p);
    return new ResponseEntity<Medicament>(p, new HttpHeaders(), HttpStatus.OK);
  }

@RequestMapping(value="/medicament/{id}/{denumire}", method = RequestMethod.PUT)
  public ResponseEntity update(@PathVariable("id") int id,
                               @PathVariable("denumire") String denumire) {
 for(Medicament p : this.med) {
      if(p.getId() == id) 
       {
        p.setDenumire(denumire);
        return new ResponseEntity<Medicament>(p, new HttpHeaders(), HttpStatus.OK);
       }

    }
     return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
}



  @RequestMapping(value="/medicament/{id}", method = RequestMethod.DELETE)
  public ResponseEntity remove(@PathVariable("id") int id) {
    for(Medicament p : this.med) {
      if(p.getId() == id) {
        this.med.remove(p);
        return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NO_CONTENT);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }


}