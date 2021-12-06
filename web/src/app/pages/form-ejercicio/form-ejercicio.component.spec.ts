import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormEjercicioComponent } from './form-ejercicio.component';

describe('FormEjercicioComponent', () => {
  let component: FormEjercicioComponent;
  let fixture: ComponentFixture<FormEjercicioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ FormEjercicioComponent ]
    })
    .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(FormEjercicioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
