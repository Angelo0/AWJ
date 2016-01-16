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
public class StudentController {
  private ArrayList<Student> stud = new ArrayList<Student>();

  StudentController() {

    
    Student p1 = new Student(1, "Student1", 2, "322 CC");
    Student p2 = new Student(2, "Student2", 1, "313 AA");
    Student p3 = new Student(3, "Student3", 4, "341 A");

    stud.add(p1);
    stud.add(p2);
    stud.add(p3);
  }

  @RequestMapping(value="/student", method = RequestMethod.GET)
  public ArrayList<Student> index() {
    return this.stud;
  }

  @RequestMapping(value="/student/{id}", method = RequestMethod.GET)
  public ResponseEntity show(@PathVariable("id") int id) {
    for(Student p : this.stud) {
      if(p.getId() == id) {
        return new ResponseEntity<Student>(p, new HttpHeaders(), HttpStatus.OK);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }

  @RequestMapping(value="/student/{id}/{nume}/{an}/{serie}", method = RequestMethod.POST)
  public ResponseEntity add(@PathVariable("id") int id,
                            @PathVariable("nume") String nume,
                            @PathVariable("an") long an,
                            @PathVariable("serie") String serie) {
    Student p = new Student(id, nume, an, serie);
    this.stud.add(p);
    return new ResponseEntity<Student>(p, new HttpHeaders(), HttpStatus.OK);
  }

@RequestMapping(value="/student/{id}/{nume}", method = RequestMethod.PUT)
  public ResponseEntity update(@PathVariable("id") int id,
                               @PathVariable("nume") String nume) {
 for(Student p : this.stud) {
      if(p.getId() == id) 
       {
        p.setNume(nume);
        return new ResponseEntity<Student>(p, new HttpHeaders(), HttpStatus.OK);
       }

    }
     return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
}



  @RequestMapping(value="/student/{id}", method = RequestMethod.DELETE)
  public ResponseEntity remove(@PathVariable("id") int id) {
    for(Student p : this.stud) {
      if(p.getId() == id) {
        this.stud.remove(p);
        return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NO_CONTENT);
      }
    }
    return new ResponseEntity<String>(null, new HttpHeaders(), HttpStatus.NOT_FOUND);
  }


}