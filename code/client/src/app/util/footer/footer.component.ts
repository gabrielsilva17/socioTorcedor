import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.sass']
})
export class FooterComponent implements OnInit {

  route: any;
  constructor(
      private router: Router
  ) { }

  ngOnInit(): void {
    this.route = location.pathname;
  }

}
