import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.sass']
})
export class NavbarComponent implements OnInit {

  route: any;
  hidden: boolean = true;

  constructor(
      private router: Router
  ) { }

  ngOnInit(): void {
    if (location.pathname == '/login') {
      this.hidden = false;
    }
    this.route = location.pathname;
  }

  onLogin(){
    this.router.navigate(['/login']);
  }

}
