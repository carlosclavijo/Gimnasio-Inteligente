import { TestBed } from '@angular/core/testing';

import { GetEjerciciosService } from './ejercicios.service';

describe('GetEjerciciosService', () => {
  let service: GetEjerciciosService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(GetEjerciciosService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
